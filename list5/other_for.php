<?php
for ($i = 1; $i <= 31; $i++){
    echo $i;
    if ($i % 7 == 0){
        echo "<br>";
    }
}
?>

<table>
    <?php for ($i = 0; $i < 5; $i++): ?>
    <tr>
        <th><?php echo $i ?></th>
        <td><?php echo $i ?>回目のループ</td>
    </tr>

<?php endfor;?>
</table>
