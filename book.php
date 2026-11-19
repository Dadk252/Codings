<?php
$file = "reservations.json";

$computers = [
    ["id" => "PC-01", "specs" => "Core i7, 16GB RAM, AutoCAD", "status" => "Available"],
    ["id" => "PC-02", "specs" => "Core i7, 16GB RAM, AutoCAD", "status" => "Available"],
    ["id" => "PC-03", "specs" => "Core i5, 8GB RAM, MS Office", "status" => "Available"],
    ["id" => "PC-04", "specs" => "Core i5, 8GB RAM, MS Office", "status" => "Available"],
    ["id" => "PC-05", "specs" => "Core i7, 32GB RAM, Adobe CC", "status" => "Maintenance"],
    ["id" => "PC-06", "specs" => "Core i5, 8GB RAM, MS Office", "status" => "Available"]
];

$reservations = [];

if (file_exists($file)) {
    $reservations = json_decode(file_get_contents($file), true);
}

$message = "";

if (isset($_POST["book_seat"])) {

    $pc = $_POST["pc_id"];
    $name = $_POST["student_name"];
    $studentId = $_POST["student_id"];
    $date = $_POST["date"];
    $slot = $_POST["time_slot"];

    $found = false;

    foreach ($reservations as $res) {
        if ($res["pc"] == $pc &&
            $res["date"] == $date &&
            $res["slot"] == $slot) {

            $found = true;
        }
    }

    if ($found) {
        $message = "Computer is already reserved!";
    } else {

        $reservations[] = [
            "id" => uniqid(),
            "pc" => $pc,
            "name" => $name,
            "student_id" => $studentId,
            "date" => $date,
            "slot" => $slot
        ];

        file_put_contents($file, json_encode($reservations));

        $message = "Reservation successful!";
    }
}
?>

<!-- Keep your original HTML and CSS here. -->

<?php if ($message != ""): ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<script>
function selectPC(id, card) {

    let cards = document.querySelectorAll(".card");

    cards.forEach(function(item) {
        item.classList.remove("selected");
    });

    card.classList.add("selected");

    document.getElementById("pc_select").value = id;
}
</script>
