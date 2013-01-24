          <h3>Settings</h3>
          <form method="post" action="?p=settings&a=save">
            <?php
            if ($_GET['fail'] === "true") {
              echo "<div class=\"error\">Username/password incorrect.</div>";
            }
            ?>
            <table class="editTable">
              <tr><td class="editLabel">First Name</td><td class="editField"><input type="text" name="email" value="" /></td></tr>
              <tr><td class="editLabel">Last Name</td><td class="editField"><input type="text" name="email" value="" /></td></tr>
              <tr><td class="editLabel">Email</td><td class="editField"><input type="text" name="email" value="<?php echo $user->getEmail(); ?>" /></td></tr>
              <tr><td class="editLabel">Password</td><td class="editField"><input type="password" name="password" /></td></tr>
              <tr><td class="editLabel">Re-enter Password</td><td class="editField"><input type="password" name="password" /></td></tr>
            </table>
            <input type="submit" value="Save Settings" />
          </form>
