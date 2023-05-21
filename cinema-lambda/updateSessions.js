const AWS = require('aws-sdk');

const dynamo = new AWS.DynamoDB.DocumentClient();

exports.handler = async (event, context) => {
  let body;
  let statusCode = '200';
  const headers = {
    'Content-Type': 'application/json',
  };

  try {
    const { date, id, backdrop_path, genres, original_language, original_title, overview, popularity, poster_path, release_date, title, vote_average, vote_count } = event.queryStringParameters;

    if (!date || !id || !title || !overview) {
      throw new Error('Missing required parameters');
    }

    const params = {
      TableName: 'Sessions',
      Item: {
        date: date,
        id: id,
        backdrop_path: backdrop_path,
        genres: genres,
        original_language: original_language,
        original_title: original_title,
        overview: overview,
        popularity: popularity,
        poster_path: poster_path,
        release_date: release_date,
        title: title,
        vote_average: vote_average,
        vote_count: vote_count
        
      },
    };

    await dynamo.put(params).promise();

    body = 'Session updated successfully';
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
