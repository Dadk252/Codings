<?php
$file = "reservations.json";

$reservations = [];

if (file_exists($file)) {
    $reservations = json_decode(file_get_contents($file), true);
}

if (isset($_GET["cancel"])) {

    $id = $_GET["cancel"];

    foreach ($reservations as $key => $res) {
        if ($res["id"] == $id) {
            unset($reservations[$key]);
        }
    }

    $reservations = array_values($reservations);

    file_put_contents($file, json_encode($reservations));

    header("Location: reservations.php");
    exit;
}
?>

<!-- Keep your original HTML and CSS here. -->

<?php foreach ($reservations as $res): ?>
<tr>
    <td><?= htmlspecialchars($res["pc"]) ?></td>
    <td><?= htmlspecialchars($res["name"]) ?></td>
    <td><?= htmlspecialchars($res["student_id"]) ?></td>
    <td><?= htmlspecialchars($res["date"]) ?></td>
    <td><?= htmlspecialchars($res["slot"]) ?></td>
    <td>
        <a href="?cancel=<?= urlencode($res["id"]) ?>"
           onclick="return confirm('Cancel this reservation?')">
           Cancel
        </a>
    </td>
</tr>
<?php endforeach; ?>
<script>
function filterTable() {

    let search = document.getElementById("searchInput").value.toLowerCase();

    let rows = document.querySelectorAll("#resTable tbody tr");

    rows.forEach(function(row) {

        let text = row.textContent.toLowerCase();

        if (text.includes(search)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }

    });
}
</script>
