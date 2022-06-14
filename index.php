
<?php 
require 'vendor/autoload.php';

use  \Aws\QuickSight\QuickSightClient;

$client = new QuickSightClient([
    'region' => 'us-east-1',
    'version' => 'latest',
    'credentials' => [
        'key'    => "AKIAYHOLWTA7AN4OK6VE",
        'secret' => "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"
    ]
]);

$result = $client->generateEmbedUrlForAnonymousUser([
        'AuthorizedResourceArns' => ['arn:aws:quicksight:us-east-1:565752272958:dashboard/3193f098-a090-4b47-b186-e7acc04a76b6'], // REQUIRED
    'AwsAccountId' => '565752272958', // REQUIRED
    'ExperienceConfiguration' => [ // REQUIRED
        'Dashboard' => [
            'InitialDashboardId' => '3193f098-a090-4b47-b186-e7acc04a76b6', // REQUIRED
        ],
    ],
    'Namespace' => 'default', // REQUIRED
    //'SessionLifetimeInMinutes' => 15,
]);
/**
 * $result = $client->generateEmbedUrlForAnonymousUser([
    'AuthorizedResourceArns' => ['<string>', ...], // REQUIRED
    'AwsAccountId' => '<string>', // REQUIRED
    'ExperienceConfiguration' => [ // REQUIRED
        'Dashboard' => [
            'InitialDashboardId' => '<string>', // REQUIRED
        ],
    ],
    'Namespace' => '<string>', // REQUIRED
    'SessionLifetimeInMinutes' => <integer>,
    'SessionTags' => [
        [
            'Key' => '<string>', // REQUIRED
            'Value' => '<string>', // REQUIRED
        ],
        // ...
    ],
]);
 *
 */

?>

<!DOCTYPE html>
    <html>

    <head>
        <title>Basic Embed</title>
        <!-- You can download the latest QuickSight embedding SDK version from https://www.npmjs.com/package/amazon-quicksight-embedding-sdk -->
        <!-- Or you can do "npm install amazon-quicksight-embedding-sdk", if you use npm for javascript dependencies -->
    </head>

    <!-- You can download the latest QuickSight embedding SDK version from https://www.npmjs.com/package/amazon-quicksight-embedding-sdk -->
    <!-- Or you can do "npm install amazon-quicksight-embedding-sdk", if you use npm for javascript dependencies -->
    <script src="https://unpkg.com/amazon-quicksight-embedding-sdk@1.19.0/dist/quicksight-embedding-js-sdk.min.js"></script>
    <script type="text/javascript">
        var dashboard;

        function embedDashboard() {
            var containerDiv = document.getElementById("embeddingContainer");
            var options = {
                // replace this dummy url with the one generated via embedding API
                //https://us-east-1.quicksight.aws.amazon.com/sn/accounts/565752272958/dashboards/519a1485-34e5-4cd5-b829-e620be6ff705?directory_alias=reworth
                url: "<?php echo $result->get('EmbedUrl'); ?>",
                container: containerDiv,
                scrolling: "no",
                height: "700px",
                width: "1000px",
                footerPaddingEnabled: true
            };
            dashboard = QuickSightEmbedding.embedDashboard(options);
        }
    </script>

    <body onload="embedDashboard()">
        <h2>Demo</h2>
        <a href="<?php echo $result->get('EmbedUrl'); ?>"> <?php echo $result->get('EmbedUrl'); ?></a>

        <div id="embeddingContainer"></div>
    </body>

    </html>