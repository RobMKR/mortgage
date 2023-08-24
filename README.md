Mortgage Calculator API

## Requirements
- PHP 8.1 or higher
- Mysql 8.0
- Composer
- Git

## Installation

- Clone the project to the directory you wish
- `cd mortgage`
- Copy env: `cp .env.example .env`
- Add your local configurations to .env to connect to mysql
- Create database `mortgage`
- Run `php artisan key:generate`
- Run `php artisan migrate`
- Run `php artisan test` to run tests
- Run `php artisan serve` to run local server (default port: 8000)
- Add postman collection to postman: https://elements.getpostman.com/redirect?entityId=9539979-acf7cc55-540c-43f3-a67e-a0e7b20bc471&entityType=collection
- Update {{host}} variable in your environment and set to your localhost where app is running (localhost:8000 if you have used `php artisan serve` command)

## Versioning
Currently there is only one version supported [V1]
But all files and structure are done for supporting more versions
V1, V2, V3 folders, route files and middleware for switching betweem the is created.

## Auth
No Auth supported

## API endpoints to prepare and approve loan 
- POST `/api/v1/prepare` to prepare and preview schedule and all details and also to retrieve `token` from response, which will be used to approve the request
- POST `/api/v1/approve` to approve already prepared loan and store in DB 

## Prepare API Request

Request example:
```json
{
    "amount": 10000,
    "interest_rate": 10,
    "duration": 2,
    "extra_monthly_payment": 100 // Optional
}
```

After request you should see:
```json
{
    "data": {
        "loanToken": "26ae7066f21d9796ebc310e64595c3cf",
        "loanData": {
            "totalAmount": 10000,
            "monthlyInterestRate": 0.008333333333333333,
            "totalNumberOfMonths": 24,
            "monthlyPayment": 461.44926337516637,
            "monthlyFixedExtraPayment": 100
        },
        "loanAmortizationSchedule": [
            {
                "monthNumber": 1,
                "startingBalance": 10000,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 378.1159300418332,
                "monthlyInterestAmount": 83.33333333333333,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 9521.884069958167
            },
            {
                "monthNumber": 2,
                "startingBalance": 9521.884069958167,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 381.26689612551513,
                "monthlyInterestAmount": 80.1823672496514,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 9040.617173832652
            },
            {
                "monthNumber": 3,
                "startingBalance": 9040.617173832652,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 384.4441202598944,
                "monthlyInterestAmount": 77.00514311527212,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 8556.173053572758
            },
            {
                "monthNumber": 4,
                "startingBalance": 8556.173053572758,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 387.6478212620602,
                "monthlyInterestAmount": 73.80144211310635,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 8068.525232310698
            },
            {
                "monthNumber": 5,
                "startingBalance": 8068.525232310698,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 390.8782197725773,
                "monthlyInterestAmount": 70.57104360258921,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 7577.64701253812
            },
            {
                "monthNumber": 6,
                "startingBalance": 7577.64701253812,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 394.13553827068216,
                "monthlyInterestAmount": 67.31372510448436,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 7083.511474267438
            },
            {
                "monthNumber": 7,
                "startingBalance": 7083.511474267438,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 397.4200010896045,
                "monthlyInterestAmount": 64.02926228556204,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 6586.091473177833
            },
            {
                "monthNumber": 8,
                "startingBalance": 6586.091473177833,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 400.7318344320179,
                "monthlyInterestAmount": 60.71742894314867,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 6085.359638745815
            },
            {
                "monthNumber": 9,
                "startingBalance": 6085.359638745815,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 404.07126638561795,
                "monthlyInterestAmount": 57.37799698954857,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 5581.288372360197
            },
            {
                "monthNumber": 10,
                "startingBalance": 5581.288372360197,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 407.4385269388315,
                "monthlyInterestAmount": 54.010736436335044,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 5073.849845421366
            },
            {
                "monthNumber": 11,
                "startingBalance": 5073.849845421366,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 410.83384799665504,
                "monthlyInterestAmount": 50.615415378511514,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 4563.015997424711
            },
            {
                "monthNumber": 12,
                "startingBalance": 4563.015997424711,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 414.2574633966272,
                "monthlyInterestAmount": 47.19179997853936,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 4048.758534028084
            },
            {
                "monthNumber": 13,
                "startingBalance": 4048.758534028084,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 417.70960892493235,
                "monthlyInterestAmount": 43.739654450234184,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 3531.0489251031513
            },
            {
                "monthNumber": 14,
                "startingBalance": 3531.0489251031513,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 421.1905223326401,
                "monthlyInterestAmount": 40.25874104252642,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 3009.858402770511
            },
            {
                "monthNumber": 15,
                "startingBalance": 3009.858402770511,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 424.7004433520788,
                "monthlyInterestAmount": 36.74882002308774,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 2485.1579594184323
            },
            {
                "monthNumber": 16,
                "startingBalance": 2485.1579594184323,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 428.2396137133461,
                "monthlyInterestAmount": 33.20964966182042,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 1956.9183457050863
            },
            {
                "monthNumber": 17,
                "startingBalance": 1956.9183457050863,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 431.80827716095735,
                "monthlyInterestAmount": 29.640986214209214,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 1425.1100685441288
            },
            {
                "monthNumber": 18,
                "startingBalance": 1425.1100685441288,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 435.40667947063196,
                "monthlyInterestAmount": 26.042583904534602,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 889.7033890734969
            },
            {
                "monthNumber": 19,
                "startingBalance": 889.7033890734969,
                "monthlyPayment": 461.44926337516637,
                "monthlyPrincipalAmount": 439.0350684662205,
                "monthlyInterestAmount": 22.414194908946047,
                "monthlyFixedExtraPayment": 100,
                "endingBalance": 350.66832060727637
            },
            {
                "monthNumber": 20,
                "startingBalance": 350.66832060727637,
                "monthlyPayment": 350.66832060727637,
                "monthlyPrincipalAmount": 331.9127512688821,
                "monthlyInterestAmount": 18.755569338394253,
                "monthlyFixedExtraPayment": 0,
                "endingBalance": 0
            }
        ]
    },
    "metadata": {
        "amount": 10000,
        "interestRate": 10,
        "duration": 2,
        "monthlyFixedExtraPayment": 100
    }
}
```

In case of any wrong input, api will return something like:
```json
{
    "type": "ERR_INVALID",
    "errors": {
        "interest_rate": [
            "The interest rate field must be between 0.01 and 99.99."
        ]
    }
}
```

## Approve API Request
Request: 
```json
{
    "token": "f0d2aeb49e80275d11a2bed964a12660"
}
```

Success Response:
```json
{
    "msg": "Loan Stored"
}
```

Error Response:
```json
{
    "type": "ERR_MESSAGE",
    "error": 404,
    "error_message": "Loan with provided token doesnt exist",
    "timestamp": 1692888510
}
```


## Web Routes

- `/` for viewing all available loans (stored in DB)

*Note that it is loading everything from db, as this is just for testing purposes, in real life usage, there must be lazy loading or at least pagination*
- `loans/1` for viewing specific loan (by id) 


## Note
Do not forget to put `Accept: application/json` and `Content-Type: application/json` in request headers, to tell our api that you are requesting json responses..

## P.S.
It's kind a strange that create is Using API endpoints and json spec, but view is simple blade views. That was done to include as many different portions of framework as possible :) 
