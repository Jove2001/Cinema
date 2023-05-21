const AWS = require('aws-sdk');

const dynamo = new AWS.DynamoDB.DocumentClient();

exports.handler = async (event, context) => {
    let body;
    let statusCode = '200';
    const headers = {
        'Content-Type': 'application/json',
    };

    try {
        const key = event.queryStringParameters.key;
        if (!key) {
            throw new Error('Missing key parameter');
        }

        const params = {
            TableName: 'Sessions',
            Key: { date: key },
        };

        body = await dynamo.get(params).promise();
    } catch (err) {
        statusCode = '400';
        body = err.message;
    } finally {
        body = JSON.stringify(body);
    }

    return {
        statusCode,
        body,
        headers,
    };
};
