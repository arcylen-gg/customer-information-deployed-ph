export class responseTemplate {
    container;
    responseBody = document.querySelector('.reponse-body');
    constructor(container) {
        this.container = container;
    }
    render(items, responseType = 'success-validation') {
        this.container.innerText = '';
        this.responseBody.classList.remove();
        if (responseType === 'error-validation') {
            const {name, email, premium_price} = items;
            if (typeof name != 'undefined' && name.length > 0) {
                for(let nameMsg of name) {
                    this.appendMsg(nameMsg);
                }
            }
            if (typeof email != 'undefined' && email.length > 0) {
                for(let emailMsg of email) {  
                    this.appendMsg(emailMsg);        
                }
            }
            if (typeof premium_price != 'undefined' && premium_price.length > 0) {
                for(let premMsg of premium_price) {  
                    this.appendMsg(premMsg);        
                }
            }
            if (typeof items != 'undefined' && items.length > 0) {
                for(let msg of items) {  
                    this.appendMsg(msg);        
                }
            }
            this.responseBody.classList.add('alert');
            this.responseBody.classList.add('alert-warning');
        } else if (responseType === 'success-get-quote') {
            const {name, premium_price} = items;
            const nameTag = `Name: ${name}`;
            const premTag = `Premium Price: ${(premium_price).toFixed(2)}`;
            this.appendMsg(nameTag);
            this.appendMsg(premTag);
        } else {
            const {message, status} = items;
            this.appendMsg(message);
            this.responseBody.classList.add('alert');
            this.responseBody.classList.add('alert-success');
        }
    }
    appendMsg(msg) {
        const li = document.createElement('li');
        const p = document.createElement('p');
        p.innerText = msg;
        li.append(p);
        this.container.append(li);
    }
}