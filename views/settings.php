<?php

// If this file is called directly, abort.
if ( ! defined('WPINC')) {
    die;
}

?><div class="wrap">
        <h2>Salesforce Pardot Settings</h2>
        <hr>
        <br>

        <form action="" method="POST">
            <?php wp_nonce_field('salesforce-pardot'); ?>
            <table class="form-table">
                <tbody>
                <tr>
                    <th scope="row">
                        <label>Salesforce Domain</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text" placeholder="https://internet.my.salesforce.com/" name="nfsalesforce[nfsalesforce_domain]" value="<?=$data['nfsalesforce_domain'];?>">
                        <p class="description"></p>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label>Salesforce Username</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text" placeholder="admin@website.com.au" name="nfsalesforce[nfsalesforce_username]" value="<?=$data['nfsalesforce_username'];?>">
                        <p class="description"></p>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label>Salesforce Password</label>
                    </th>
                    <td>
                        <input class="regular-text" placeholder="hunter2" type="password" name="nfsalesforce[nfsalesforce_password]" value="<?=$data['nfsalesforce_password'];?>">
                        <p class="description"></p>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label>Salesforce Security Token</label>
                    </th>
                    <td>
                        <input class="regular-text" type="password" name="nfsalesforce[nfsalesforce_security_token]" value="<?=$data['nfsalesforce_security_token'];?>">
                        <p class="description"></p>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label>Salesforce Client ID</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text" placeholder="website" name="nfsalesforce[nfsalesforce_client_id]" value="<?=$data['nfsalesforce_client_id'];?>">
                        <p class="description"></p>
                    </td>
                </tr>


                <tr>
                    <th scope="row">
                        <label>Salesforce Client Secret</label>
                    </th>
                    <td>
                        <input class="regular-text" type="password" placeholder="website" name="nfsalesforce[nfsalesforce_client_secret]" value="<?=$data['nfsalesforce_client_secret'];?>">
                        <p class="description"></p>
                    </td>
                </tr>


                </tbody>
            </table>
            <br>
            <input value="Save changes" type="submit" class="button button-primary">
        </form>
        <br><br>

    <hr>

    <div style="text-align: center; margin: 20px 0 20px 0;">
        <p>
            Copyright &copy; <?php echo date('Y'); ?>
            <a href="https://github.com/nicko170/ninjaforms-salesforce" target="_blank">Nick Pratley</a>
        </p>
    </div>
</div>
