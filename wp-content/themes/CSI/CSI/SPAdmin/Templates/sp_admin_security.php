<div id="poststuff" class="wrap admin-security cols-2" style="padding:10px;">
   <!--<div id="dashboard-widgets" class="metabox-holder">-->
        <div class="postbox-container postbox" style="width:48%;margin-right:20px;float: left;">
            <h3 class="hndle">Generate a htpassword</h3>
            <div class="inside">
            <form method="post" autocomplete="off">
                <table class="form-table">

                    <tr>
                        <th>Username</th>
                        <td><input name="htpass[user]" type="text" class="regular-text"/></td>
                    </tr>
                    
                    <tr>
                        <th>Password</th>
                        <td><input name="htpass[password]" type="password" class="regular-text"/></td>
                    </tr>
                    
                    <tr>
                        <td>
                            <p class="submit"><input type="submit" name="submit" id="submit"
                                                     class="button button-primary" value="Generate"></p>
                        </td>
                    </tr>
                </table>
            </form>
            </div>
        </div>

    <!--</div>-->

        <div class="postbox-container postbox" style="width:49%;float: left;">
            <h3 class="hndle">Security Issues</h3>
            <div class="inside">
            <form method="post">
                <table class="form-table">
                    <span>Full Path for reference: '.ABSPATH.'</span>

                    <tr>
                        <th>Path to .htpassword</th>
                        <td><input name="htoptions[path]" type="text" class="regular-text" value="<?php echo $current ?>"/></td>
                    </tr>
                    <tr>
                        <td>
                            <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save New Path"></p>
                        </td>
                    </tr>


                </table>
            </form>
            </div>
        </div>
        <?php
if (!file_exists(ABSPATH . '/wp-admin/.htaccess')) {
    $txt = <<<EOT
AuthType Basic
AuthName
"SparkPlug Protected Area"
AuthUserFile $current
Require valid-user

<Files admin-ajax.php>
    Order allow,deny
    Allow from all
    Satisfy any
</Files>

<Files "\.(css|gif|png|js)$">
    Order allow,deny
    Allow from all
    Satisfy any
</Files>
EOT;
        ?>


    <?php
    if(isset($_POST['htpass'])){
        $username = $_POST['htpass']['user'];
        $password = $_POST['htpass']['password'];

        $encrypted_password = base64_encode(sha1($password, true));
        ?>
        <div class="postbox-container postbox" style="clear: both;width:48%;">
            <h3 class="hndle">Content for .htpassword</h3>
            <table class="form-table">
                <tr>
                    <td><textarea rows="5" cols="46" class="regular-text" style="width: 100%;"><?php echo $username . ' : ' . $encrypted_password ?></textarea></td>
                </tr>
            </table>
        </div>
    <?php } ?>


    <div class="clear"></div>


    <div class="postbox-container postbox">
            <h3 class="hndle">Please add the following to the /wp-admin/.htaccess</h3>
            <div class="inside">
            <table class="form-table">
                <tr><td>Content for .htaccess</td></tr>
                <tr>
                    <td><textarea rows="20" cols="100" class="regular-text" style="width: 100%;"><?php echo $txt ?></textarea></td>
                </tr>
            </table>
            <?php } ?>
            </div>
        </div>
</div>