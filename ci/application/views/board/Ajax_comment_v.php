<table cellpadding="0" cellspacing="0" class="table table-striped">
    <tbody>
         
    <?php
        foreach ($comment  as $lt) {
    ?>
     
        <tr>
            <th scope="row">
                <?php  echo $lt->username; ?>
            </th>
 
            <td><?php echo $lt->contents; ?></td>
             
            <td><?php  echo $lt->board_date; ?></td>
 
            <td><a href="">삭제</a></td>
        </tr>
 
    <?php
        }
    ?>
    </tbody>
</table>