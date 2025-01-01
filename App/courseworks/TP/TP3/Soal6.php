<?php
    // 3.6.1 Implementasi fungsi array_push()
    $fruits = ["Apple", "Banana", "Cherry"];
    $originalFruits = $fruits;
    array_push($fruits, "Dragon Fruit", "Elderberry");
    echo "<b>array_push() Implementation:</b> <br>";
    echo "Original Fruits: " . implode(", ", $originalFruits) . "<br>";
    echo "Added Fruits: " . implode(", ", array_diff($fruits, $originalFruits)) . "<br>";
    echo "Fruits after array_push: " . implode(", ", $fruits) . "<br><br>";

    // 3.6.2 Implementasi fungsi array_merge()
    $moreFruits = ["Fuzzy Kiwi", "Grape"];
    echo "<b>array_merge() Implementation:</b> <br>";
    echo "Fruits before array_merge: " . implode(", ", $fruits) . "<br>";
    $mergedFruits = array_merge($fruits, $moreFruits);
    echo "Fruits after array_merge: " . implode(", ", $mergedFruits) . "<br><br>";

    // 3.6.3 Implementasi fungsi array_values()
    $student = array(
        "name" => "Achmad Ridho Fa'iz",
        "age" => 19,
        "major" => "Computer Science",
        "subjects" => array(
            "Web Programming",
            "Algorithms",
            "Data Structures"
        )
    );
    $studentValues = array_values($student);
    echo "<b>array_values() Implementation:</b> <br>";
    echo "MahaSIGMA:\n";
    foreach ($studentValues as $value) {
        if (is_array($value)) {
            echo "<br>";
            echo "Subjects:\n";
            foreach ($value as $subject) {
                echo "- " . $subject . "\n";
            }
        } else {
            echo $value . "\n";
        }
    }
    echo "<br><br>";
    
    // 3.6.4 Implementasi fungsi array_search()
    $searchFruit = "Cherry";
    $searchResult = array_search($searchFruit, $fruits);
    echo "<b>array_search() Implementation:</b> <br>";
    echo "The index of $searchFruit in fruits: " . ($searchResult !== false ? $searchResult : "Not found") . "<br><br>";

    // 3.6.5 Implementasi fungsi array_filter()
    $filteredFruits = array_filter($fruits, function($fruit) {
        return strlen($fruit) > 5; // Filter fruits with names longer than 5 characters
    });
    echo "<b>array_filter() Implementation:</b> <br>";
    echo "Fruits with names longer than 5 characters: " . implode(", ", $filteredFruits) . "<br><br>";

    // 3.6.6 Implementasi berbagai fungsi sorting
    sort($fruits);
    echo "<b>Sort in Ascending (SORT) Order:</b> <br>";
    echo "Fruits sorted in ascending order: " . implode(", ", $fruits) . "<br><br>";
    rsort($fruits);
    echo "<b>Sort in Descending (KSORT) Order:</b> <br>";
    echo "Fruits sorted in descending order: " . implode(", ", $fruits) . "<br><br>";

    // Sort associative array by values
    $associativeFruits = ["Apple" => 1, "Banana" => 2, "Cherry" => 3];
    asort($associativeFruits);
    echo "<b>Sort Associative Array by Values:</b> <br>";
    echo "Fruits sorted by values: " . implode(", ", array_keys($associativeFruits)) . "<br><br>";
    // Sort associative array by keys
    ksort($associativeFruits);
    echo "<b>Sort Associative Array by Keys:</b> <br>";
    echo "Fruits sorted by keys: " . implode(", ", array_keys($associativeFruits)) . "<br><br>";
?>