/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/carousel.js":
/*!**********************************!*\
  !*** ./resources/js/carousel.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

listen('input.add-photo-input', 'change', function () {
  document.querySelector('form#upload-image-no-album').submit();
});
addEvent(document.querySelectorAll('.carousel'), 'wheel', function (e) {
  e.preventDefault();
  var slideshow_id = context(e.path, '.carousel').id;
  scrollSlides(slideshow_id, e);
});
var time = Date.now();

function scrollSlides(slideshow_id, e) {
  var wait = 500;
  if (time + wait - Date.now() > 0) return;
  time = Date.now();
  var radios = document.querySelectorAll("#".concat(slideshow_id, " input[type=radio]")); // left

  if (e.deltaX > 0 || e.deltaY < 0) {
    // previous
    for (i = 0; i < radios.length; i++) {
      var el = radios[i];

      if (el.checked) {
        el.checked = false;

        if (radios[i - 1]) {
          radios[i - 1].checked = true;
        } else {
          radios[radios.length - 1].checked = true;
        }

        return;
      }
    }
  } // right
  else if (e.deltaX < 0 || e.deltaY > 0) {
      // next
      for (i = 0; i < radios.length; i++) {
        var _el = radios[i];

        if (_el.checked) {
          _el.checked = false;

          if (radios[i + 1]) {
            radios[i + 1].checked = true;
          } else {
            radios[0].checked = true;
          }

          return;
        }
      }
    }
}

/***/ }),

/***/ 2:
/*!****************************************!*\
  !*** multi ./resources/js/carousel.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\User\projects\galleria\resources\js\carousel.js */"./resources/js/carousel.js");


/***/ })

/******/ });