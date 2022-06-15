
<?php 
require 'vendor/autoload.php';

use  \Aws\QuickSight\QuickSightClient;

    $client = new QuickSightClient([
        'region' => 'us-east-1',
        'version' => 'latest',
        'credentials' => [
            'key'    => getenv("AWS_KEY"),
            'secret' => getenv("AWS_SECRET")
        ]
    ]);

    //$report_id = '519a1485-34e5-4cd5-b829-e620be6ff705';
    $report_id = '2ab0b40b-ed60-49d7-8059-8020c7fbba1d';

    $result = $client->generateEmbedUrlForAnonymousUser([
        'AuthorizedResourceArns' => ['arn:aws:quicksight:us-east-1:565752272958:dashboard/' . $report_id ], // REQUIRED
        'AwsAccountId' => '565752272958', // REQUIRED
        'ExperienceConfiguration' => [ // REQUIRED
            'Dashboard' => [
                'InitialDashboardId' => $report_id, // REQUIRED
            ],
        ],
        'Namespace' => 'default', // REQUIRED
        //'SessionLifetimeInMinutes' => 15,
    ]);

?>

<!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Basic Embed</title>
        <!-- You can download the latest QuickSight embedding SDK version from https://www.npmjs.com/package/amazon-quicksight-embedding-sdk -->
        <!-- Or you can do "npm install amazon-quicksight-embedding-sdk", if you use npm for javascript dependencies -->
    </head>
    <style>
        body{
            display: flex;
            position: relative;
            height: auto;
            flex-direction: column;
        }
    </style>
    <!-- You can download the latest QuickSight embedding SDK version from https://www.npmjs.com/package/amazon-quicksight-embedding-sdk -->
    <!-- Or you can do "npm install amazon-quicksight-embedding-sdk", if you use npm for javascript dependencies -->
    <script src="https://unpkg.com/amazon-quicksight-embedding-sdk@1.19.0/dist/quicksight-embedding-js-sdk.min.js"></script>
    <script type="text/javascript">
        var dashboard;
                function embedDashboard() {
                    var containerDiv = document.getElementById("embeddingContainer");
                    var options = {
                        url: "<?php echo $result->get('EmbedUrl'); ?>",
                        container: containerDiv,
                        scrolling: "no",
                        height: "700px",
                        width: "100%",
                        footerPaddingEnabled: true,
                        parameters: {
                            "FnzInst": '<?php echo $_GET['fi']; ?>'
                        },
                    };
                    dashboard = QuickSightEmbedding.embedDashboard(options);
                }
    </script>

    <body onload="embedDashboard()">
        <h2>Demo</h2>

        <div id="embeddingContainer"></div>
    </body>

    </html>