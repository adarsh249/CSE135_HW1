// register.js

const registerForm = document.getElementById('registrationForm');

registerForm.addEventListener('submit', async (event) => {
  event.preventDefault();

  const username = document.getElementById('regUsername').value;
  const email = document.getElementById('regEmail').value;
  const password = document.getElementById('regPassword').value;
  const admin = document.getElementById('regAdmin').checked;

  const userData = {
    username,
    email,
    password,
    admin,
  };

  try {
    const res = await fetch('https://reporting.cse151group111.online/user/register', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(userData),
    }).then(response => {
      response.json().then(data => {
      if(response.status != 200) {
        error.innerHTML = data.msg;
      }
      else {
        console.log(data);
      }
    })
  }).catch(error => {
    console.log(error);
  });
  } catch (error) {
    console.error(error);
  }
});

// update.js

const updateForm = document.getElementById('updateForm');

updateForm.addEventListener('submit', async (event) => {
  event.preventDefault();

  const username = document.getElementById('updUsername').value;
  const email = document.getElementById('updEmail').value;
  const password = document.getElementById('updPassword').value;
  const admin = document.getElementById('updAdmin').checked;

  const userData = {
    username,
    email,
    password,
    admin,
  };

  try {
    const res = await fetch('https://reporting.cse151group111.online/user/update', {
      method: 'PATCH',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(userData),
    }).then(response => {
      response.json().then(data => {
        if(response.status != 200){
          error.innerHTML = data.msg;
        }
        else{
          console.log(data);
        }
      })
    }).catch(error => {
      console.log(error);
    })
  } catch (error) {
    console.error(error);
  }
});

const deleteForm = document.getElementById('deleteForm');

deleteForm.addEventListener('submit', async (event) => {
  event.preventDefault();

  const username = document.getElementById('delusername').value;
  const email = document.getElementById('delemail').value;

  const deleteData = {
    username,
    email,
  };

  try {
    const res = await fetch('https://reporting.cse151group111.online/user/delete', {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(deleteData),
    }).then(response => {
      response.json().then(data => {
        if(response.status != 200){
          error.innerHTML = data.msg;
        }
        else {
          console.log(data);
        }
      })
    }).catch(error => {
      console.log(error);
    });
  } catch (error) {
    console.error(error);
  }
});