// fetch-transaction-petition

const transactions = "https://jsonplaceholder.typicode.com/users";

fetch(transactions)
    .then((response) => response.json())
    .then((data) => showData(data));
    const tBodyTransactions = document.getElementById('fetch-transaction-petition')
    
    console.log(tBodyTransactions);
    function showData(data) {
        console.log(data);
        data.map((transaction, index) => {
            console.log("hola");
            tBodyTransactions.innerHTML += `
          <tr>
            <th scope="row">${index + 1}</th>
            <td>${transaction.name}</td>
            <td>${transaction.username}</td>
            <td>${transaction.email}</td>
          </tr>
        `;
        });
    }

