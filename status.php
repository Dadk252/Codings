<?php
$computers = [
    ["id" => "PC-01", "specs" => "Core i7, 16GB RAM, AutoCAD", "status" => "Available"],
    ["id" => "PC-02", "specs" => "Core i7, 16GB RAM, AutoCAD", "status" => "Available"],
    ["id" => "PC-03", "specs" => "Core i5, 8GB RAM, MS Office", "status" => "Available"],
    ["id" => "PC-04", "specs" => "Core i5, 8GB RAM, MS Office", "status" => "Available"],
    ["id" => "PC-05", "specs" => "Core i7, 32GB RAM, Adobe CC", "status" => "Maintenance"],
    ["id" => "PC-06", "specs" => "Core i5, 8GB RAM, MS Office", "status" => "Available"]
];
?>

<!-- Keep your original HTML and CSS here. -->

<?php foreach ($computers as $pc): ?>
<tr>
    <td><?= $pc["id"] ?></td>
    <td><?= $pc["specs"] ?></td>
    <td>
        <span class="badge <?= $pc["status"] ?>">
            <?= $pc["status"] ?>
        </span>
    </td>
</tr>
<?php endforeach; ?>
