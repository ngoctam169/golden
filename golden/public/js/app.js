function button2(e){
    var id = e.dataset.id;
    $.ajax({
        type: 'GET',
        url:'./mvc/controller/product.php',
        data:{"id":id}
    }).done(function(data){
        var data = JSON.parse(data);
        var cart = data.cart;
        var temp1 = `.shop-item-button[data-id=${id}]`;
        //console.log(temp1);
        var temp2 = `.button1[data-id=${id}]`;
        var dolar = '$';
        var total
         = data.total;
        var temp = "";
        cart.forEach(function(value){
            temp += `
                <div class="card-item">
                    <div class="card-item-left">
                        <div class="card-item-image" style="background-color:${value.color}">
                            <div class="card-item-image-block"><img class="image" src="${value.image}"></div>
                        </div>
                    </div>
                    <div class="card-item-right">
                        <div class="card-item-name">${value.name}</div>
                        <div class="card-item-price">$${value.price}</div>
                        <div class="card-item-actions">
                            <div class="card-item-count"> 
                                <div class="card-item-count-button">
                                    <button class="button-minus" data-id="${value.id}"><img src="./public/image/minus.png" class="minus"></button>
                                </div>
                                <div class="card-item-count-number">${value.quality}</div>
                                <div class="card-item-count-button">
                                    <button class="button-plus" data-id="${value.id}"><img src="./public/image/plus.png" class="plus"></button>
                                </div>
                            </div>
                            <div class="card-item-remove">
                                <button class="button-trash" data-id="${value.id}"><img src="./public/image/trash.png" class="cart-item-remove-icon"></button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        })
        $(temp2).addClass('d-none');
        $(`${temp1}`).removeClass('d-none');
        // var test = $(`${temp1}`);
        // console.log(test);  
        $('.card-items').html(temp);
        $('.card-title-amount').html(total);
        $('.card-empty').remove();

    });

}
var count = $('.card-item-count-number'); 
var minus = $('.button-minus');
var trash = $('.button-trash');

    $(document.body).on("click", '.button-plus', function(){
       var id = this.dataset.id;
       $.ajax({
            type: 'GET',
            url:'./mvc/controller/plus.php',
            data:{"id":id}
        }).done(function(data){
           var data = JSON.parse(data);
            var cart = data.cart;
            var total = data.total;
            var temp = "";
            cart.forEach(function(value){
                temp += `
                    <div class="card-item">
                        <div class="card-item-left">
                            <div class="card-item-image" style="background-color:${value.color}">
                                <div class="card-item-image-block"><img class="image" src="${value.image}"></div>
                            </div>
                        </div>
                        <div class="card-item-right">
                            <div class="card-item-name">${value.name}</div>
                            <div class="card-item-price">$${value.price}</div>
                            <div class="card-item-actions">
                                <div class="card-item-count"> 
                                    <div class="card-item-count-button">
                                        <button class="button-minus" data-id="${value.id}"><img src="./public/image/minus.png" class="minus"></button>
                                    </div>
                                    <div class="card-item-count-number">${value.quality}</div>
                                    <div class="card-item-count-button">
                                        <button class="button-plus" data-id="${value.id}"><img src="./public/image/plus.png" class="plus"></button>
                                    </div>
                                </div>
                                <div class="card-item-remove">
                                    <button class="button-trash" data-id="${value.id}"><img src="./public/image/trash.png" class="cart-item-remove-icon"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

            });
            $('.card-items').html(temp);
            $('.card-title-amount').html(total);
        });
    });

    $(document.body).on("click", '.button-minus', function(){
        var id = this.dataset.id;
        var quality = this.dataset.quality;
       console.log(quality);
       $.ajax({
            type: 'GET',
            url:'./mvc/controller/minus.php',
            data:{"id":id}
        }).done(function(data){
            var data = JSON.parse(data);
            var cart = data.cart;
            var total = data.total;
            var temp1 = `.shop-item-button[data-id=${id}]`;
            var temp2 = `.button1[data-id=${id}]`;
            var temp3 = `.button-minus[data-quality=${quality}]`;
            console.log(temp3)
            var temp = "";
            cart.forEach(function(value){
                temp += `
                    <div class="card-item">
                        <div class="card-item-left">
                            <div class="card-item-image" style="background-color:${value.color}">
                                <div class="card-item-image-block"><img class="image" src="${value.image}"></div>
                            </div>
                        </div>
                        <div class="card-item-right">
                            <div class="card-item-name">${value.name}</div>
                            <div class="card-item-price">$${value.price}</div>
                            <div class="card-item-actions">
                                <div class="card-item-count"> 
                                    <div class="card-item-count-button">
                                        <button class="button-minus" data-id="${value.id}" data-quality="${value.quality}"><img src="./public/image/minus.png" class="minus"></button>
                                    </div>
                                    <div class="card-item-count-number" >${value.quality}</div>
                                    <div class="card-item-count-button">
                                        <button class="button-plus" data-id="${value.id}"><img src="./public/image/plus.png" class="plus"></button>
                                    </div>
                                </div>
                                <div class="card-item-remove">
                                    <button class="button-trash" data-id="${value.id}"><img src="./public/image/trash.png" class="cart-item-remove-icon"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
            });
            $('.card-items').html(temp);
            if(quality - 1 == 0){
               // $(temp3).addClass('d-none');
                $(temp2).removeClass('d-none');
                $(temp1).addClass('d-none');

            };
            
            $('.card-title-amount').html(total);
            
        });
    });

var remove =  document.querySelector('.button-trash')
    $(document.body).on("click", '.button-trash', function(){
        var id = this.dataset.id;
        $.ajax({
            url: './mvc/controller/remove.php',
            type: 'GET',
            data:{"id":id}
        }).done(function(data){
             var data = JSON.parse(data);
            var cart = data.cart;
            var total = data.total;
            var temp2 = `.button1[data-id=${id}]`;
            var temp1 = `.shop-item-button[data-id=${id}]`;
            var temp = "";
            cart.forEach(function(value){
                temp += `
                    <div class="card-item">
                        <div class="card-item-left">
                            <div class="card-item-image" style="background-color:${value.color}">
                                <div class="card-item-image-block"><img class="image" src="${value.image}"></div>
                            </div>
                        </div>
                        <div class="card-item-right">
                            <div class="card-item-name">${value.name}</div>
                            <div class="card-item-price">$${value.price}</div>
                            <div class="card-item-actions">
                                <div class="card-item-count"> 
                                    <div class="card-item-count-button">
                                        <button class="button-minus" data-id="${value.id}"><img src="./public/image/minus.png" class="minus"></button>
                                    </div>
                                    <div class="card-item-count-number">${value.quality}</div>
                                    <div class="card-item-count-button">
                                        <button class="button-plus" data-id="${value.id}"><img src="./public/image/plus.png" class="plus"></button>
                                    </div>
                                </div>
                                <div class="card-item-remove">
                                    <button class="button-trash" data-id="${value.id}"><img src="./public/image/trash.png" class="cart-item-remove-icon"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            })
        // var test = $(`${temp1}`);
        // console.log(test);
        $(temp1).addClass('d-none');
        $(temp2).removeClass('d-none');
        $('.card-items').html(temp);
        $('.card-title-amount').html(total);
        
        
        });

    }); 