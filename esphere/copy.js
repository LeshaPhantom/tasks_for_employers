let invoices = [{
    "customer": "MDT",
    "performances": [{
            "playID": "Гамлет",
            "audience": 55,
            "type": "tragedy"
        },
        {
            "playID": "Ромео и Джульетта",
            "audience": 35,
            "type": "tragedy"
        },
        {
            "playID": "Отелло",
            "audience": 40,
            "type": "comedy"
        }
    ]
}]

console.clear();

console.log(statement(invoices[0]));


function amountFor(aPerformance) {

    let result = 0;

    switch (aPerformance.type) {
        case "tragedy":
            result = 40000;
            if (aPerformance.audience > 30) {
                result += 1000 * (aPerformance.audience - 30);
            }
            break;
        case "comedy":
            result = 30000;
            if (aPerformance.audience > 20) {
                result += 10000 + 500 * (aPerformance.audience - 20);
            }
            result += 300 * aPerformance.audience;
            break;
        default:
            throw new Error(`неизвестный тип: ${aPerformance.type}`);
    }
    return result;
}

function volumeCreditsFor(aPerformance) {
    let result = 0;
    result += Math.max(aPerformance.audience - 30, 0);
    if ("comedy" === aPerformance.type) result += Math.floor(aPerformance.audience / 5);
    return result;
}

function format(aNumber) {
    return new Intl.NumberFormat("ru-RU", {
        style: "currency",
        currency: "RUB",
        minimumFractionDigits: 2
    }).format(aNumber);
}

function statement(invoice) {
    let totalAmount = 0;
    let volumeCredits = 0;
    let result = `Счет для ${invoice.customer}\n`;

    for (let perf of invoice.performances) {
        volumeCredits += volumeCreditsFor(perf);


        // Вывод строки счета 
        result += `  ${perf.playID}: ${format(amountFor(perf)/100)} (${perf.audience} бонусов)\n`;
        totalAmount += amountFor(perf);
    }
    result += `Итого с вас ${format(totalAmount/100)}\n`;
    result += `Вы заработали ${volumeCredits} бонусов\n`;
    return result;
}


//REFACTORING Martin Fowler