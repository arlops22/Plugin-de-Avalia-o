document.addEventListener('DOMContentLoaded', function(e) {
    
    const rateForm = document.getElementById('rate-form'),
          status = document.querySelector('[data-message="status"]'),
          modal = document.getElementById('myModal'),
          close = document.getElementById('closeModal'),
          open = document.getElementById('openModal');

    open.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    close.addEventListener('click', ()=> {
        modal.style.display = 'none';
    });

    rateForm.addEventListener('submit', e => {
        
        e.preventDefault();

        let message = rateForm.querySelector('[name="message"]')

        if (!message.value) {

            status.innerHTML = 'Existem campos que ainda não foram preenchidos!';
            message.style.boxShadow = '0 0 5px red';
        
        } else {

            let url = rateForm.dataset.url;

            let params = new URLSearchParams(new FormData(rateForm));

            fetch(url, {
                method: "POST",
                body: params
            })
            .then(response => {
                response.json();
            })
            .then(json => {            
                rateForm.reset();
                status.innerHTML = 'Feedback enviado com sucesso! SAVIO agradece por sua opinião.';
                message.style.boxShadow = 'unset';
            })
            .catch(err => {
                console.log(err.message)
            })

            
        }

    })  

})
