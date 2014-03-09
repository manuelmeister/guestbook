<?php

echo '<div class="entry user">
    <img src="img/user-512.png" width="120px" height="120px" class="userimage">
    <h2>' . $user['username'] . '</h2>
    <h3>' . $user['firstname'] . ' ' . $user['familyname'] . '</h3>
    <p class="date">Datum des Beitritts: ' . $user['userjoined'] . '</p>
</div>';