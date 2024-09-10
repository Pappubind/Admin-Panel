<?php
include 'header.php';
include 'dbconn.php';


$query = "SELECT * FROM service WHERE id = 1";
$query_run = mysqli_query($conn, $query);


$service = mysqli_fetch_assoc($query_run);

// Function to clean up the HTML content
function cleanHtmlContent($htmlContent)
{
    $dom = new DOMDocument();
    libxml_use_internal_errors(true); 
    $dom->loadHTML($htmlContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    libxml_clear_errors();

    // Get all <p> tags
    $pTags = $dom->getElementsByTagName('p');
    $removeNodes = [];

    // Identify <p> tags to remove
    foreach ($pTags as $pTag) {
        if (trim($pTag->nodeValue) === '' || trim($pTag->nodeValue) === '&nbsp;') {
            $removeNodes[] = $pTag;
        }
    }

    // Remove the identified <p> tags
    foreach ($removeNodes as $node) {
        $node->parentNode->removeChild($node);
    }

    return $dom->saveHTML();
}

?>

<header>
    <?php
    if ($service) {
        echo htmlspecialchars($service['name']);
    } 
    ?>
</header>

<section>
    <div class="container-xxl py-5">
        <div class="container images-row fadeInOut rounded">
            <?php
            if ($service) {
                ?>
                <img src="<?php echo htmlspecialchars($service['image1']); ?>" class="rounded" width="325" height="300"
                    alt="Image1">
                <img src="<?php echo htmlspecialchars($service['image2']); ?>" class="rounded" width="325" height="300"
                    alt="Image2">
                <img src="<?php echo htmlspecialchars($service['image3']); ?>" class="rounded" width="325" height="300"
                    alt="Image3">
                <?php
            } else {
                echo "<p>No images found for this service.</p>";
            }
            ?>
        </div>
        <div class="service-description">
            <?php
            if ($service) {
                echo cleanHtmlContent($service['description']);
            } else {
                echo "<p>No description found for this service.</p>";
            }
            ?>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>

<style>
    .container-xxl {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        align-items: center;
        background-color: aliceblue;
        border-radius:8px ;
    }

    .images-row img {
        margin: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        transition: transform 0.3s;
    }

    .images-row img:hover {
        transform: scale(1.1);
    }

    .fadeInOut {
        animation: fadeInOut ease-in-out infinite;
    }

    @keyframes fadeInOut {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }
    }

    .service-description {
        margin-top: 20px;
        font-size: 18px;
        color: black;
    }

    header {
        font-size: 2.5em;
        font-weight: bold;
        /* Bold text */
        color: #333;
        /* Dark text color for better readability */
    }
</style>