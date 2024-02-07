<?php
session_start();

define('USE_LDAP', true); // Validate against Active Directory false to use DB
define('CHECK_GROUP', false); //Check for group membership?
define('DOMAIN_FQDN', 'MY.FQDN'); //Replace with REAL DOMAIN FQDN
define('LDAP_SERVER', 'x.x.x.x');  //Replace with REAL LDAP SERVER Address
define('LDAP_GROUP', 'groupname'); //Name of group in AD
define('USER_BASE', 'OU=XX,DC=XX,DC=XX'); //Use your local AD base

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include "../../database/config.php";
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!USE_LDAP) {
        $enc_password = hash('sha256', $password, false);
        $sql = "SELECT * from teachers where email='$username' AND password='$enc_password'";
        $res = $conn->query($sql);
        if ($res->num_rows == 1) {
            //if login successful then initialize the session
            $row = $res->fetch_assoc();
            initSess($row['id']);

            echo "success";
        } else {
            echo "fail";
        }
    } else {
        if (testLDAP($username, $password)) {

            $sql = "SELECT * from teachers where email='$username';";
            $res = $conn->query($sql);

            if ($res->num_rows == 0) {
                //User not found so add to local DB
                $sql = "INSERT INTO teachers (`email`) VALUES ('$username');";
                $res = $conn->query($sql);
                //Initialize session with last index
                initSess($conn->insert_id);
            } else {
                //User exists so just use ID for session
                $row = $res->fetch_assoc();
                initSess($row['id']);
            }
            echo "success";
        } else {
            echo "fail";
        }
    }
}
//initialize session
function initSess($id)
{
    $_SESSION["user_id"] = $id;
}
function testLDAP($user, $pass)
{
    //set variables for AD query
    $uname =  $user . '@' . DOMAIN_FQDN;

    //Try LDAP connection
    $ds = ldap_connect("ldap://" . LDAP_SERVER . "/");

    if ($ds) { //Connection successful?

        //try bind to test for valid user credentials
        $ldapbind = @ldap_bind($ds, $uname, $pass);
        if (!$ldapbind) {
            //bad crecentials login failed
            return false;
        }

        //Create filter for upn from username
        $filter = "(userPrincipalName=" . $uname . ")";

        // Search for upn in base path
        $sr = ldap_search($ds, USER_BASE, $filter);

        if (ldap_count_entries($ds, $sr) == 0) {
            //Account not found
            return false;
        } elseif (ldap_count_entries($ds, $sr) == 1) {
            //Account found so...
            //is CHECK_GROUP set? If not then return good login
            if (!CHECK_GROUP) {
                //Login OK
                return true;
            } else {
                //Otherwise get group members
                $info = ldap_get_entries($ds, $sr);

                //search for user in LDAP_GROUP group
                if (wildcard_in_array("CN=" . LDAP_GROUP, $info[0]['memberof'])) {
                    //User found in group
                    return true;
                } else {
                    //User not found in group
                    return false;
                }
            }
        }
    } else {
        //LDAP connection error
        return false;
    }
}
//Search group member array
function wildcard_in_array($string, $array = array())
{
    foreach ($array as $key => $value) {
        unset($array[$key]);
        if (strpos($value, $string) !== false) {
            $array[$key] = $value;
        }
    }
    return $array;
}
