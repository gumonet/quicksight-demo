
<?php 
require 'vendor/autoload.php';

use  \Aws\QuickSight\QuickSightClient;



if( isset($_GET['if']) ) {
    $client = new QuickSightClient([
        'region' => 'us-east-1',
        'version' => 'latest',
        'credentials' => [
            'key'    => getenv("AWS_KEY"),
            'secret' => getenv("AWS_SECRET")
        ]
    ]);

    $report_id = 'null';
    switch ( $_GET ){
        case 'dinn':
            $report_id = '565752272958:dashboard/3193f098-a090-4b47-b186-e7acc04a76b6';
            break;
        case 'castor':
            $report_id = '565752272958:dashboard/3193f098-a090-4b47-b186-e7acc04a76b6';
            break;
        default:
            break;
    }

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
}

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

        <?php if( $report_id !== 'null'){ ?>
                function embedDashboard() {
                    var containerDiv = document.getElementById("embeddingContainer");
                    var options = {
                        url: "<?php echo $result->get('EmbedUrl'); ?>",
                        container: containerDiv,
                        scrolling: "no",
                        height: "700px",
                        width: "100%",
                        footerPaddingEnabled: true
                    };
                    dashboard = QuickSightEmbedding.embedDashboard(options);
                }
        <?php }?>
    </script>

    <body onload="embedDashboard()">
        <h2>Demo</h2>


        <div id="embeddingContainer"></div>
    </body>

    </html>