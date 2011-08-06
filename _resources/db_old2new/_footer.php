<?php

@mysql_free_result($result);
mysql_query('SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS', $link);
mysql_query('SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS', $link);

mysql_close($link);
echo '<br><br>Connection closed';
