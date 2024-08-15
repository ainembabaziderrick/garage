
const openeditmodal = (id,name,cost_price,price) =>{

    $('#editmodal').modal('show');
    document.getElementById('id').value = id;

    document.getElementById('recipient_name').value = name;
    document.getElementById('recipient_cost_price').value = cost_price;
    document.getElementById('recipient_price').value = price;

    console.log(name,cost_price,price);
    

}

const openeditmodalss = (id,name,address) =>{

    $('#editmodals').modal('show');
    document.getElementById('id').value = id;

    document.getElementById('recipient_name').value = name;
    document.getElementById('recipient_cost_price').value = address;

}


const openeditmodalw = (id,name,address) =>{

    $('#editmodalw').modal('show');
    document.getElementById('id').value = id;

    document.getElementById('recipient_name').value = name;
    document.getElementById('recipient_cost_price').value = address;

}

