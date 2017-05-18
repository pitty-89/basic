function Button(selector) {
    this.button = document.getElementById(selector);                            // Кнопка
    this.formButton = this.closestByTag(this.button, 'FORM');                   // Родительская форма для кнопки
    this.oRemove = this.getOption(this.formButton, 'btn-action', 'remove');     // Опция для удаления уже добавленных кнопок
}
/**
 * Возвращает родителя по тегу
 * @param elem - элемент для которого необходимо вернуть родителя
 * @param tagName - название тега родителя
 * @returns {*}
 */
Button.prototype.closestByTag = function(elem, tagName) {
    while(elem.tagName != tagName) {
        elem = elem.parentNode;
        if(!elem) {
            return null;
        }
    }
    return elem;
};
/**
 * Возвращает значение input или select из формы
 * @param form - форма в которой находится поле
 * @param name - название поля значение которого необходимо вернуть
 */
Button.prototype.getValue = function(form, name) {
    var inputText = form.elements[name];
    return inputText.value;
};
/**
 * Возвращает опцию селектора по значению из формы
 * @param form - форма в которой находится селектор
 * @param nameSelect - название селектора
 * @param option - значение опции
 */
Button.prototype.getOption = function(form, nameSelect, option) {
    var sRemove = form.elements[nameSelect];
    for(var i = 0; i < sRemove.options.length; i++) {
        if(sRemove.options[i].value == option) {
            return sRemove.options[i];
        }
    }
};
/**
 * Добавляет кнопку после формы
 * @param form - форма после которой производится добавление кнопки
 * @param oRemove - опция с действием на удаление кнопки
 */
Button.prototype.addButton = function(form, oRemove) {
    var btnText = form.elements['btn-text'].value,
        parent = form.parentNode;
    if(!btnText) {
        btnText = 'Default';
    }
    var button = document.createElement('button');
    button.className = 'btn ' + form.elements['btn-class'].value;
    button.innerHTML = btnText;
    if(oRemove.disabled) {
        oRemove.disabled = false;
    }
    if(parent.getElementsByTagName('button').length > 1) {
        var lButton = parent.getElementsByTagName('button')[1];
        lButton.parentNode.insertBefore(button, lButton);
    } else {
        parent.appendChild(button);
    }
};
/**
 * Удаляет последнюю добавленную кнопку
 * @param form - форма из которой производится удаление
 * @param oRemove - опция с действием на удаление кнопки
 */
Button.prototype.removeButton = function(form, oRemove) {
    var parent = form.parentNode;
    parent.removeChild(parent.getElementsByTagName('button')[1]);
    if(parent.getElementsByTagName('button').length == 1) {
        form.elements['btn-action'].value = 'add';
        oRemove.disabled = true;
    }
};

window.onload = function() {
    var idButton = 'click';
    document.getElementById(idButton).onclick = function(event) {
        event.preventDefault();
        var b = new Button(idButton);
        if(b.getValue(b.formButton, 'btn-action') == 'add') {
            b.addButton(b.formButton, b.oRemove);
        } else if(b.getValue(b.formButton, 'btn-action') == 'remove') {
            b.removeButton(b.formButton, b.oRemove);
        }
    };
};