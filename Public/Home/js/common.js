function addImgUrlPrefix(string) {

    var imgs = string.getNodesByTagName('img');
    for (var i in imgs) {

        var src =imgs[i].getAttr('src');
        imgs[i].setAttr('src', imgUrlPrefix + src);

    }
    string = string.toHtml();
    return string;
}