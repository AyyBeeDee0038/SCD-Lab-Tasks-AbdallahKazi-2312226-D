const taskInput = document.getElementById('taskInput');
const addBtn = document.getElementById('addBtn');
const taskList = document.getElementById('taskList');
const clearBtn = document.getElementById('clearBtn');

// Load tasks from local storage
document.addEventListener('DOMContentLoaded', loadTasks);

// Add task
addBtn.addEventListener('click', addTask);

// Clear all tasks
clearBtn.addEventListener('click', clearAllTasks);

// Function to add a task
function addTask() {
    const taskText = taskInput.value.trim();
    if (taskText === '') {
        alert('Please enter a task');
        return;
    }

    const li = document.createElement('li');
    li.textContent = taskText;

    const deleteBtn = document.createElement('button');
    deleteBtn.textContent = 'Delete';
    deleteBtn.addEventListener('click', deleteTask);
    li.appendChild(deleteBtn);

    taskList.appendChild(li);
    saveTasks();

    taskInput.value = ''; // Clear input field
    alert('Task added successfully!');
}

// Function to delete a task
function deleteTask(e) {
    const task = e.target.parentElement;
    task.remove();
    saveTasks();
}

// Function to clear all tasks
function clearAllTasks() {
    taskList.innerHTML = '';
    saveTasks();
}

// Save tasks to local storage
function saveTasks() {
    const tasks = [];
    const taskItems = taskList.querySelectorAll('li');
    taskItems.forEach(task => {
        tasks.push(task.textContent.replace('Delete', '').trim());
    });
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

// Load tasks from local storage
function loadTasks() {
    const tasks = JSON.parse(localStorage.getItem('tasks')) || [];
    tasks.forEach(taskText => {
        const li = document.createElement('li');
        li.textContent = taskText;

        const deleteBtn = document.createElement('button');
        deleteBtn.textContent = 'Delete';
        deleteBtn.addEventListener('click', deleteTask);
        li.appendChild(deleteBtn);

        taskList.appendChild(li);
    });
}
