<!--autocomplete end-->
  <script type="text/javascript"> 
    $(function(){
	// jQuery.noConflict();
        var availabledrugs=<?= json_encode($getemvendor); ?>;
        $('#vendor').autocomplete({
	 select: function(event,ui){
  $(this).val((ui.item ? ui.item.id : ""));
},
        source: availabledrugs,
        select: function( event, ui )
		{
		var valshow=ui.item.value;
		var barcode=ui.item.idval;
		 $('#vendor').val(valshow);
		 $('#vendid').val(ui.item.idval);
		}
        });
});
    
    $(function(){
	// jQuery.noConflict();
        var availabledrugs=<?= json_encode($getemproduct); ?>;
        $('#product').autocomplete({
	    maxResults: 10,
	 select: function(event,ui){
  $(this).val((ui.item ? ui.item.id : ""));
},
       source: function(request, response) {
        var results = $.ui.autocomplete.filter(availabledrugs, request.term);
        
        response(results.slice(0, this.options.maxResults));
    },
        select: function( event, ui )
		{
		var valshow=ui.item.value;
		var barcode=ui.item.idval;
		 $('#product').val(valshow);
		 $('#porid').val(ui.item.idval);
                 $.ajax({url:"purch_product_detail.php?pid="+barcode,success:function(result)
		 {
                    var obj=result.split(",");
                    $('#compid').val(obj[0]);
                    $('#company').val(obj[1]);
                    $('#catid').val(obj[2]);
                    $('#category').val(obj[3]);
                    $('#barcode').val(obj[4]);
		 }
		 });
		 
		}
		
		
        });
	$.ui.autocomplete.filter = function (array, term) { var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(term), "i"); return $.grep(array, function (value) { return matcher.test(value.label || value.value || value); }); };
});
    
    $(function(){
	// jQuery.noConflict();
        var availabledrugs=<?= json_encode($getemcompany); ?>;
        $('#company').autocomplete({
	    maxResults: 10,
	 select: function(event,ui){
  $(this).val((ui.item ? ui.item.id : ""));
},
        source: function(request, response) {
        var results = $.ui.autocomplete.filter(availabledrugs, request.term);
        
        response(results.slice(0, this.options.maxResults));
    },
        select: function( event, ui )
		{
		var valshow=ui.item.value;
		var barcode=ui.item.idval;
		 $('#company').val(valshow);
		 $('#compid').val(ui.item.idval);
		}
        });
	$.ui.autocomplete.filter = function (array, term) { var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(term), "i"); return $.grep(array, function (value) { return matcher.test(value.label || value.value || value); }); };
});
    
    $(function(){
	// jQuery.noConflict();
        var availabledrugs=<?= json_encode($getemcategory); ?>;
        $('#category').autocomplete({
	     maxResults: 10,
	 select: function(event,ui){
  $(this).val((ui.item ? ui.item.id : ""));
},
        source: function(request, response) {
        var results = $.ui.autocomplete.filter(availabledrugs, request.term);
        
        response(results.slice(0, this.options.maxResults));
    },
        select: function( event, ui )
		{
		var valshow=ui.item.value;
		var barcode=ui.item.idval;
		 $('#category').val(valshow);
		 $('#catid').val(ui.item.idval);
		}
        });
	$.ui.autocomplete.filter = function (array, term) { var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(term), "i"); return $.grep(array, function (value) { return matcher.test(value.label || value.value || value); }); };
});
</script>
<script type="text/javascript">
    $(function(){
        var availabledrug=<?= json_encode($getemail); ?>;
        $('#cateid').autocomplete({
	 select: function(event,ui){
  $(this).val((ui.item ? ui.item.id : ""));
},
        source: availabledrug,
        select: function( event, ui )
		{
		var valshow=ui.item.value;
        $('#cateid').val(valshow);
		 $('#hdcatid').val(ui.item.idval);
        return false;
		}
        });
});
</script>
<script type="text/javascript">
    $(function(){
        var availabledrugs=<?= json_encode($getemails); ?>;
        $('#compnid').autocomplete({
	 select: function(event,ui){
  $(this).val((ui.item ? ui.item.id : ""));
},
        source: availabledrugs,
        select: function( event, ui )
		{
		var valshow=ui.item.value;
        $('#compnid').val(valshow);
		 $('#hdcompid').val(ui.item.idval);
        return false;
		}
        });
});
</script>
<script language="javascript">
function deleteRow(t)
{
   
    document.getElementById("table1").deleteRow(t);

}

function addRow(tableID){
var table=document.getElementById(tableID);
var rowCount=table.rows.length;
var lastRow = table.rows[ table.rows.length - 1 ];
rowCount1=lastRow.id-0+1;
var row=table.insertRow(rowCount);
        row.id=rowCount;
var cell1=row.insertCell(0);
var element1=document.createElement("input");
        element1.type="button";
        element1.value="-";
        element1.name="purchase["+rowCount1+"][minus]";
        element1.id="minus"+rowCount1;
        element1.className="minus textbox";
        cell1.appendChild(element1);
        $(element1).click( function(){  deleteRow(this.parentNode.parentNode.rowIndex) });
var cell2=row.insertCell(1);
var element2=document.createElement("input");
        element2.type="text";
        element2.name="purchase["+rowCount1+"][barcode]";
        element2.id="barcode"+rowCount1;
        //element2.setAttribute('elementid',rowCount);
        element2.className="barcode textbox";
        cell2.appendChild(element2);
        var b=$('#barcode').val();
        if (b!="") {element2.value=b; $('#barcode').val(""); }
         $('.barcode').blur( function(){
		 barcode(rowCount);
		 });
var cell3=row.insertCell(2);
var element3=document.createElement("input");
        element3.type="text";
        element3.name="purchase["+rowCount1+"][product]";
        element3.id="product"+rowCount1;
        element3.className="product textbox";
        cell3.appendChild(element3);
		
		//var prd=$('#product').val();
		// if (prd!="") {element3.value=prd; }
		
        $("#product"+rowCount1).blur( function(){  product(rowCount); });
var cell4=row.insertCell(3);
var element4=document.createElement("input");
        element4.type="text";
        element4.name="purchase["+rowCount1+"][quantity]";
        element4.id="quantity"+rowCount1;
        element4.className="quantity textbox";
        cell4.appendChild(element4);
	
var cell5=row.insertCell(4);
var element5=document.createElement("input");
        element5.type="text";
        element5.name="purchase["+rowCount1+"][freeqty]";
        element5.id="freeqty"+rowCount1;
        element5.className="freeqty textbox";
        cell5.appendChild(element5);
	$('.freeqty').blur( function(){  totqty(rowCount); });
var cell6=row.insertCell(5);
var element6=document.createElement("input");
        element6.type="text";
        element6.name="purchase["+rowCount1+"][totqty]";
        element6.id="totqty"+rowCount1;
        element6.className="totqty textbox";
        cell6.appendChild(element6);
var cell7=row.insertCell(6);
var element7=document.createElement("input");
        element7.type="text";
        element7.name="purchase["+rowCount1+"][mrp]";
        element7.id="mrp"+rowCount1;
        element7.className="mrp textbox";
        cell7.appendChild(element7);
		
		
var cell8=row.insertCell(7);
var element8=document.createElement("input");
        element8.type="text";
        element8.name="purchase["+rowCount1+"][priceunit]";
        element8.id="priceunit"+rowCount1;
        element8.className="priceunit textbox";
        cell8.appendChild(element8);
        $('.priceunit').blur( function(){  totqty(rowCount); });
var cell9=row.insertCell(8);
var element9=document.createElement("input");
        element9.type="text";
        element9.name="purchase["+rowCount1+"][totprice]";
        element9.id="totprice"+rowCount1;
        element9.className="totprice textbox";
        cell9.appendChild(element9);
var cell10=row.insertCell(9);
var element10=document.createElement("input");
        element10.type="text";
        element10.name="purchase["+rowCount1+"][spldis]";
        element10.id="spldis"+rowCount1;
        element10.className="spldis textbox";
        cell10.appendChild(element10);
var cell11=row.insertCell(10);
var element11=document.createElement("input");
        element11.type="text";
        element11.name="purchase["+rowCount1+"][deldis]";
        element11.id="deldis"+rowCount1;
        element11.className="deldis textbox";
        cell11.appendChild(element11);
var cell12=row.insertCell(11);
var element12=document.createElement("input");
        element12.type="text";
        element12.name="purchase["+rowCount1+"][schdis]";
        element12.id="schdis"+rowCount1;
        element12.className="schdis textbox";
        cell12.appendChild(element12);
var cell13=row.insertCell(12);
var element13=document.createElement("input");
        element13.type="text";
        element13.name="purchase["+rowCount1+"][taxin]";
        element13.id="taxin"+rowCount1;
        element13.className="taxin textbox";
        cell13.appendChild(element13);
	$('.taxin').blur( function(){  discount(rowCount); });
var cell14=row.insertCell(13);
var element14=document.createElement("input");
        element14.type="text";
        element14.name="purchase["+rowCount1+"][tottax]";
        element14.id="tottax"+rowCount1;
        element14.className="tottax textbox";
        cell14.appendChild(element14);
var cell15=row.insertCell(14);
var element15=document.createElement("input");
        element15.type="text";
        element15.name="purchase["+rowCount1+"][totamt]";
        element15.id="totamt"+rowCount1;
        element15.className="totamt textbox";
        cell15.appendChild(element15);
        

var cell16=row.insertCell(15);
var element16=document.createElement("input");
        element16.type="hidden";
        element16.name="purchase["+rowCount1+"][pid]";
        element16.id="pid"+rowCount1;
        element16.className="pid textbox";
        cell16.appendChild(element16);
        cell16.setAttribute("hidden", true);
var cell17=row.insertCell(16);
var element17=document.createElement("input");
        element17.type="hidden";
        element17.name="purchase["+rowCount1+"][orderno]";
        element17.id="orderno"+rowCount1;
        element17.className="orderno textbox";
        cell17.appendChild(element17);
        cell17.setAttribute("hidden", true);
var cell18=row.insertCell(17);
var element18=document.createElement("input");
        element18.type="hidden";
        element18.name="purchase["+rowCount1+"][vendorid]";
        element18.id="vendorid"+rowCount1;
        element18.className="vendorid textbox";
        cell18.appendChild(element18);
        cell18.setAttribute("hidden", true);
var cell19=row.insertCell(18);
var element19=document.createElement("input");
        element19.type="hidden";
        element19.name="purchase["+rowCount1+"][companyid]";
        element19.id="companyid"+rowCount1;
        element19.className="companyid textbox";
        cell19.appendChild(element19);
        cell19.setAttribute("hidden", true);
var cell20=row.insertCell(19);
var element20=document.createElement("input");
        element20.type="text";
        element20.name="purchase["+rowCount1+"][categoryid]";
        element20.id="categoryid"+rowCount1;
        element20.className="categoryid textbox";
        cell20.appendChild(element20);
        cell20.setAttribute("hidden", true);

        }
        
function barcode(barcodeid)
{
     var bar=$('#barcode'+barcodeid).val();
     var ordernum=$('#order').val();
     var vendor=$('#vendid').val();
     var comp=$('#compid').val();
     var cat=$('#catid').val();
     if (vendor=="") { vendor=1;}
    $.ajax({url:"purchase_detail.php?bar="+bar,success:function(result)
		 {
                    var obj = JSON.parse(result);
                    $("#product"+barcodeid).val(obj.prod_name);
                    $("#pid"+barcodeid).val(obj.id);
                    $("#mrp"+barcodeid).val(obj.mrp);
                     $("#priceunit"+barcodeid).val(obj.price);
                     $("#orderno"+barcodeid).val(ordernum);
                     $("#vendorid"+barcodeid).val(vendor);
                     $("#companyid"+barcodeid).val(comp);
                      $("#categoryid"+barcodeid).val(cat);
                       // alert("inside");
                      $("#product").val("");
                      $("#porid").val("");
                      $("#company").val("");
                      $("#compid").val("");
                      $("#category").val("");
                      $("#catid").val("");
                      //$("#barcode"+barcodeid).val(obj.barcode);
                     
		 }});
}
function product(barcodeid)
{
     var prod=$('#product'+barcodeid).val();
     var ordernum=$('#order').val();
     var vendor=$('#vendid').val();
     var comp=$('#compid').val();
     if (comp=="") { comp=$("#companyid"+barcodeid).val();}
     var cat=$('#catid').val();
     if (cat=="") { cat=$("#categoryid"+barcodeid).val();}
     if (vendor=="") { vendor=1;}
    $.ajax({url:"purchase_detail.php?prod="+prod,success:function(result)
		 {
                    var obj = JSON.parse(result);
                    $("#barcode"+barcodeid).val(obj.barcode);
                    $("#pid"+barcodeid).val(obj.product_id);
                    $("#mrp"+barcodeid).val(obj.mrp);
                     $("#priceunit"+barcodeid).val(obj.price);
                     $("#orderno"+barcodeid).val(ordernum);
                     $("#vendorid"+barcodeid).val(vendor);
                     $("#companyid"+barcodeid).val(comp);
                     $("#categoryid"+barcodeid).val(cat);
		 }});
}
function fixbarcode(bar)
{
    $.ajax({url:"purch_product_detail.php?bar="+bar,success:function(result)
		 {
                    var obj=result.split(",");
                    $('#compid').val(obj[0]);
                    $('#company').val(obj[1]);
                    $('#catid').val(obj[2]);
                    $('#category').val(obj[3]);
                    //$('#barcode').val(obj[4]);
                    $('#porid').val(obj[5]);
                    $('#product').val(obj[6]);
		 }});
    addRow('table1')
}


function totqty(keyval)
{
var qty=$("#quantity"+keyval).val();
if (qty=="")
{
    qty=0;
}
var freeqty=$("#freeqty"+keyval).val();
if (freeqty=="")
{
    freeqty=0;
}
var priceunit=$("#priceunit"+keyval).val();
var totqty=parseInt(qty)+parseInt(freeqty);
var totprice=qty*priceunit;
$("#totqty"+keyval).val(totqty);
$("#totprice"+keyval).val(totprice);

}


function discount(disval)
{
var spldis=$("#spldis"+disval).val();
if (spldis==""){ spldis=0;}
var deldis=$("#deldis"+disval).val();
if (deldis=="")
{
    deldis=0;
}
var schdis=$("#schdis"+disval).val();
if (schdis=="")
{
    schdis=0;
}
var tax=$("#taxin"+disval).val();
if (tax=="")
{
    tax=0;
}
var totaldis=parseFloat(spldis)+parseFloat(deldis)+parseFloat(schdis);
var tot=$("#totprice"+disval).val();
var totalamt=parseFloat(tot)+(parseFloat(tot)*(totaldis/100));
if (tax!="")
{
    var totaltax=totalamt-(totalamt*(parseFloat(tax)/100));
}
$("#totamt"+disval).val(totalamt);
$("#tottax"+disval).val(totaltax);
}


function checkform() {
    
    var table=document.getElementById('table1');
    var form=document.getElementById('f');
    form.appendChild(table);
}

<script>
		function validate()
		{
		var name=document.getElementById('name').value;
		var phonee=document.getElementById('phone').value;
		var emailid=document.getElementById('email').value;
		var format = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; 
		if(name=="")
		{
		alert("enter a name");
		return false;
		}
		if(phonee=="")
		{
		alert("enter contact number");
		return false;
		}
		if(phonee.length<10)
	{
	 alert("Enter 10 digit contact number");

			return false;
	}
	if(phonee.length>10)
	{
	 alert("Enter 10 digit contact number");

			return false;
	}
	if(emailid!="" && !emailid.match(format))

	{

	alert("You have entered an wrong email address!"); 
	return false;
    

	}
		}
		function valid()
		{
		var prodval=$('#prod').val();
		if(prodval=="")
		{
		alert("enter product");
		return false;
		}
		}
		</script>
 <script type="text/javascript">
function numbersonly(e){
var unicode=e.charCode? e.charCode : e.keyCode
if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
if (unicode<48||unicode>57) //if not a number
return false //disable key press
}
}
</script>
