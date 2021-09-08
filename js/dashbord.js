$(function() {
    var name = document.getElementById('NewName');
    var address = document.getElementById('NewAddress');
    var search = document.getElementById('SearchValue');

    $('#AddEmp').click(function() {
        AddData();
        AddData().catch(error => {
            console.log("error!");
            console.log(error);
        });
    });

    $('#SearchBtn').click(function() {
        var search = $('#SearchValue').val();
        if (search.length > 0) {
            if (isNaN(search)) {
                SearchName();
                SearchName().catch(error => {
                    console.log("error!");
                    console.log(error);
                });
            } else {
                SearchId();
                SearchId().catch(error => {
                    console.log("error!");
                    console.log(error);
                });
            }
        } else {
            alert('search bar is Empty!');
        }
    });
});

async function AddData() {
    const response = await fetch('http://localhost/ci1/index.php/dashbord/AddEmp', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: {
            Name: name.value,
            Address: address.value
        }
    });
    const result = await response.text();
    console.log(result);
}

async function SearchName() {
    const response = await fetch('http://localhost/ci1/index.php/dashbord/search', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: {
            SearchValue: search.value,
            SearchType: 'name'
        }
    });
    const result = await response.text();
    console.log(result);
}

async function SearchId() {
    const response = await fetch('http://localhost/ci1/index.php/dashbord/search', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: {
            SearchValue: search.value,
            SearchType: 'id'
        }
    });
    const result = await response.text();
    console.log(result);
}


// function AddData() {
//     $.ajax({
//         type: 'POST',
//         URL: "<?php echo base_url('index.php/dashbord/AddEmp'); ?>",
//         async: false,
//         data: '{"Name":' + name.value + ', "Address":' + address.value + '}',
//         dataType: 'json',
//         success: function(data) {
//             console.log(data);
//         },
//         error: function(response) {
//             console.log(response.responseText);
//             alert("error while connecting to database");
//         }
//     })

// fetch('<?php echo base_url('index.php/dashbord/AddEmp'); ?>', {
//     method: 'POST',
//     headers: {
//         'Content-Type': 'application/json'
//     },
//     body: {
//         Name: name.value
//     }
// }).then(res => res.text()).then(res => console.log(res));
// }

// function SearchName() {
//     var search = $('#SearchValue').val();
//     console.log(search);
//     $.ajax({
//         type: 'GET',
//         URL: '<?php echo base_url('index.php/dashbord/AddEmp'); ?>',
//         async: false,
//         data: {
//             SearchType: "Name",
//             SearchValue: Search.value
//         },
//         dataType: 'json',
//         success: function(data) {

//         },
//         error: function() {
//             alert("error while connecting to database");
//         }
//     });
// }

// function SearchId() {
//     var search = $('#SearchValue').val();
//     console.log(search);
//     $.ajax({
//         type: 'POST',
//         URL: '<?php echo base_url('index.php/dashbord/AddEmp'); ?>',
//         async: false,
//         data: "SearchValue=" + search.value(),
//         dataType: 'json',
//         success: function(data) {

//         },
//         error: function() {
//             alert("error while connecting to database");
//         }
//     });
// }