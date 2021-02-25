(function(){

//Wyświetlanie daty na stronie

const data = document.getElementById("date"); //pobranie pojemnika

var date = new Intl.DateTimeFormat('hy-AM').format(date); //format dd-mm-yyy

data.innerText="Dzisiaj mamy: " + date; //wyświetlenie na stronie


//SKRYTP DO TODO    
const form = document.getElementById("form");
const input = document.getElementById("input");
const todosUl = document.getElementById("todos");

const todos = JSON.parse(localStorage.getItem('todos')); //pobranie notatek z localStorage

//sprawdzenie czy istnieje notatka w localStorage
if (todos) {
    todos.forEach(todo => {
        addTodo(todo); // jeśli istnieje to wyślij notatkę do funkcji addTodo
    });

    //wywołanie funkcji addTodo po wysłaniu formularza.
    form.addEventListener("submit", (e) => {
        e.preventDefault(); //strona nie przeładuje się
        addTodo();
    });

    function addTodo(todo) {

        let todoText = input.value;

        //jeśli istnieje notatka z LocalStorage to pobierz wartość z tablicy asoc. z indexu "text"
        if (todo) {
            todoText = todo.text;
        }

        const todoEl = document.createElement("li"); //tworzymy pojemnik na treść notatki

        //sprawdzenie czy notatka z LS posiadała klasę completed jeśli tak to dodajemy do pojemnika todoEl klasę completed 
        if (todo && todo.completed) {
            todoEl.classList.add("completed");
        }

        //dodajemy do pojemnika treść notatki
        todoEl.innerText = todoText;

        //AKCJE MYSZĄ

        //odznaczanie zrealizowanego taska

        todoEl.addEventListener('click', () => {
            todoEl.classList.toggle("completed");
            updateLS();
        });

        //usuwanie taska

        todoEl.addEventListener('contextmenu', (e) => {
            e.preventDefault();
            todoEl.remove();
            updateLS();
        });

        todosUl.appendChild(todoEl); //dodajemy zadanie do listy na stronie
        input.value = ""; //zerujemy pole z inputem
        updateLS(); //aktualizacja localStorage
    }
}

function updateLS() {
    const todosEl = document.querySelectorAll("li");

    const todos = [];

    todosEl.forEach(todoEl => {
        todos.push({
            text: todoEl.innerText, //pobranie treści z obiektu na stronie i wrzucenie do indexu text
            completed: todoEl.classList.contains("completed") //sprawdzenie czy notatka posiada klasę completed
        })
    });
    
    localStorage.setItem("todos", JSON.stringify(todos)); //dodanie notatek do localStorage
}

})();