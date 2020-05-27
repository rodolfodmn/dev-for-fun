import Api from './data/Api.js'

let Main = (function (){

    function init() {
        alert(teste)
    }

    return {
        init: init
    }
})();

export default Main;

document.addEventListener(
    'DOMContentLoaded',
    Main.init()
)
