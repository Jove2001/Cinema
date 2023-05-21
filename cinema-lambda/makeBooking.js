const AWS = require('aws-sdk');

const dynamo = new AWS.DynamoDB.DocumentClient();

exports.handler = async (event, context) => {
  let body;
  let statusCode = '200';
  const headers = {
    'Content-Type': 'application/json',
  };

  try {
    const { date, email, id, tickets } = event.queryStringParameters;

    if (!date || !email || !id || !tickets) {
      throw new Error('Missing required parameters');
    }

    const params = {
      TableName: 'Bookings',
      Item: {
        date: date,
        email: email,
        id: id,
        tickets: tickets,
      },
    };

    await dynamo.put(params).promise();

    body = 'Booking created successfully';
  } catch (err) {
    statusCode = '400';
    body = err.message;
  }

  return {
    statusCode,
    body,
    headers,
  };
};
