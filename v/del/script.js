//
//Обработка ввода
//

//Заглавная буква в начале строки, прописные остальные буквы
function Uppercase(){
    var str=$('#name').val();
	var array=str.split(/[\s]/);
	var nev=new Array();
	for(i=0; i<array.length; i++){
        var s=array[i].substr(0,1);
	    var myReg=/[-А-Я]/;
	    var arr=myReg.exec(s);
	    if(arr==null){
            u=s.toUpperCase();
        }else{
	        u=s;
	    }
	    str=array[i].replace(s,u);
	    nev.push(str);
	}
	string=nev.join(" ");
    $('#name').val(string);
}

$('#sub').click(Uppercase);

//Проверка корректности введенного в поле символа
function Reg(myReg,str,al){
    var length=str.length-1;
	var s=str.substr(length,1);
	var arr=(length!=-1)?myReg.exec(s):1;
	if(arr==null){
	    alert("Введен недопустимый символ. "+al);
	}
}
function N(){
    Reg(/[-А-Яа-я\s]/,str=$(this).val(),al=" Вводить можно только русские буквы, знак пробела и тире");
}
function D(){
    Reg(/[0-9\.\s]/,str=$(this).val(),al=" Вводить можно только цифры и точку");
}
function P(){
    Reg(/[-0-9\s\(\)]/,str=$(this).val(),al=" Вводить можно только цифры, скобки и знак тире");
}
$('#name').keyup(N);
$('#datepicker').keyup(D);
$('#phone').keyup(P);


//Календарь
$("#datepicker").datepicker({
    inline:true
});


//
//Удаление
//
$('.del').click(function(){
    id=$(this).attr("id");
	id=id.slice(1);
	var s=confirm("Вы действительно хотите удалить запись номер "+id+"?");
    if(s){
	    $('.del').attr('href','./index.php?act=del&&id='+id);
    }
});







		
	
	
	
	
	