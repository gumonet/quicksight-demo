

aws --profile prod quicksight generate-embed-url-for-anonymous-user --aws-account-id 565752272958 --namespace default --authorized-resource-arns "arn:aws:quicksight:us-east-1:565752272958:dashboard/519a1485-34e5-4cd5-b829-e620be6ff705" --experience-configuration Dashboard={InitialDashboardId=519a1485-34e5-4cd5-b829-e620be6ff705}



aws --profile prod quicksight get-dashboard-embed-url --region us-east-1 --namespace default --dashboard-id 15febea5-78b6-419a-a2d0-d75f73b289ab --identity-type ANONYMOUS --aws-account-id 565752272958
OA