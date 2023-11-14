<?php
function authenticateWithLDAP($ldap_server, $ldap_user_dn, $ldap_password, $group) {
    $ldapconn = ldap_connect($ldap_server) or die("Could not connect to LDAP server.");

    if ($ldapconn) {
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

        $bind = @ldap_bind($ldapconn, $ldap_user_dn, $ldap_password);

        if ($bind) {
            $filter="(sAMAccountName=" . explode('\\', $ldap_user_dn)[1] . ")";
            $result = ldap_search($ldapconn, $ldap_user_dn, $filter);
            ldap_sort($ldapconn, $result, "sn");
            $info = ldap_get_entries($ldapconn, $result);

            if ($info["count"] > 0) {
                $userdn = $info[0]["dn"];
                $memberof = $info[0]["memberof"];

                foreach ($memberof as $member) {
                    if (strpos($member, 'CN=' . $group) !== false) {
                        return true;
                    }
                }
            }
        }
    }
    return false;
}
?>
