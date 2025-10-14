<?php 
if (empty($trendings)) {
    echo "<p>Nenhum trending encontrado.</p>";
    return;
}
else {
    echo "<ul>";
    foreach ($trendings as $trending) {
        echo "<li>";
        echo "<strong>#" . htmlspecialchars($trending->hashtag) . "</strong> - " . $trending->postsCount . " posts";
        echo "</li>";
    }
    echo "</ul>";
}
?>  