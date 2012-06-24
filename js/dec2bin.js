function Decimal_to_binary(x)
{
answer=new Object();
x2=x;
log2=0;
while(x2>=2){
	x2=x2/2;
	log2=log2+1;
}

for(l2=log2; l2>=0; l2--){
	power=Math.pow(2,l2);
	if (x>=power) {
		answer[l2]="1";
		x=x-power;
	}		
	else answer[l2]="0";
}
for (i=log2; i>=0; i--){
	document.forms[0].elements[1].value+=(answer[i]);	

}
}
function Binary_to_decimal(x)
{

y=parseInt(x,2);
if (isNaN(y))
	alert(x + " is not a binary number");
else
	document.forms[1].elements[1].value=y;
}

function explaindec(x)
{

var ex = open("","explanation","width=300,height=150,scrollbars=yes");

ex.document.write("The number <FONT COLOR=BLUE>" + x +"</FONT>");
answer=new Object();
x2=x;
log2=0;
while(x2>=2){
	x2=x2/2;
	log2=log2+1;
}
ex.document.write(" can be expressed as: <BR><FONT COLOR=BLUE>");
for(l2=log2; l2>=0; l2--){
	power=Math.pow(2,l2);
	if (x>=power) {
		answer[l2]="1";
		x=x-power;
		if (l2<log2)
			ex.document.write(" " + "+" + " ");
		ex.document.write(power);
	}
	else answer[l2]="0";
}
ex.document.write("</FONT><BR>So, the answer is: ");
ex.document.write("<FONT COLOR=RED>");
for (i=log2; i>=0; i--){
	ex.document.write(answer[i]);
}

ex.document.write("</FONT> ");
ex.document.write("<P>");
ex.document.write("<FORM>");
ex.document.write("<INPUT TYPE=BUTTON VALUE='Continue' onClick='window.close()'>");
ex.document.write("</FORM>");
}

function explainbin(x)
{


y=parseInt(x,2);
if (isNaN(y)){
	alert(x + " is not a binary number");
	return;
}

var ex = open("","explanation","width=300,height=150,scrollbars=yes");
ex.document.write("The number <FONT COLOR=BLUE>" + x +"</FONT>");
ex.document.write(" represents: <BR><FONT COLOR=BLUE>");
hipow=x.length-1;
for(l=0;l<x.length;l++){
	digit=x.substring(l,l+1);
	if (digit=='1'){
		power=Math.pow(2,hipow-l);
		if (l>0)
			ex.document.write(" " + "+" + " ");
		ex.document.write(power);
	}
}
ex.document.write("</FONT><BR>So, the answer is: ");
ex.document.write("<FONT COLOR=RED>");
ex.document.write(y);
ex.document.write("</FONT> ");
ex.document.write("<P>");
ex.document.write("<FORM>");
ex.document.write("<INPUT TYPE=BUTTON VALUE='Continue' onClick='window.close()'>");
ex.document.write("</FORM>");
}

function answer(correct,which) {
	if (document.forms[0].elements[which].value == correct) {
		alert("Correct!");
	}
	else {
		alert("Try again.");
	}
}
function give(correct,which) {

	document.forms[0].elements[which].value = correct;
}
//End hide -->