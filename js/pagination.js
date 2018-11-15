var picsPerPage = 5;
var offset = 0;
var numpics = countPics();
var numPages = Math.ceil(numpics / picsPerPage);
var imagediv = document.getElementById("images");

function prevset() {

    offset = +offset - picsPerPage;
    if (offset < 0) {
        offset = 0;
    }
    fetchPics();
}

function nextset() {
    offset = +offset + picsPerPage;
    if (offset > parseInt(numpics)) {
        offset = 0;
    }
    fetchPics();
}

function countPics() {
    var hr = new XMLHttpRequest();
    var url = "ajax.php";

    var vars = "picCounter=SHO";
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            numpics = return_data;
        }
    }
    hr.send(vars);
}

function fetchPics() {
    var hr = new XMLHttpRequest();
    var url = "ajax.php";

    var vars = "offset2=" + offset + "&limit=" + picsPerPage;
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function () {
        if (hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;

            //append or switch src
            queryRes = JSON.parse(return_data);
            //alert(queryRes);
            //console.log(queryRes);
            arrLength = queryRes.length;
            var myNode = document.getElementById("images");
            while (myNode.firstChild) {
                myNode.removeChild(myNode.firstChild);
            }
            for (var i = 0; i < arrLength; i++) {
                var img = document.createElement('img');
                var comment = document.createElement('input');
                var comment_form = document.createElement('form');
                img.setAttribute('id', "eg" + i);
                img.setAttribute('src', queryRes[i]['img_name']);
                img.setAttribute('onclick', 'alert(this.id)');
                comment_form.setAttribute('onclick', 'alert(this.id)');
                myNode.appendChild(img);
                comment_form.appendChild(comment);
                myNode.appendChild(comment_form);

                


            }
            // alert(arrLength);

        }
    }
    hr.send(vars);
}

window.onload = function () {
    fetchPics();
}