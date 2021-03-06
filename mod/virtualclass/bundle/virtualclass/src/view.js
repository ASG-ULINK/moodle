// This file is part of Vidyamantra - http:www.vidyamantra.com/
/**@Copyright 2014  Vidyamantra Edusystems. Pvt.Ltd.
 * @author  Suman Bogati <http://www.vidyamantra.com>
  */
(
    function(window) {
        var view = {
          init : function (){
              this.msgBoxClass = 'msgBox';
              this.window = {};
              this.virtualWindow = {};
              return this;
          },

          displayMessage : function(msg, id, className, intoAppend, imageTag) {
              if (typeof imageTag == 'undefined') {
                  var msgBox = this.createMsgBox(msg, id, className);
              } else {
                  var msgBox = this.createMsgBox(msg, id, className, imageTag);
              }

              var parTag = document.getElementById('vcanvas');
              if (typeof intoAppend != 'undefined') {
                  document.getElementById(intoAppend).appendChild(msgBox);
              } else {
                  parTag.insertBefore(msgBox, parTag.childNodes[0]);
              }
          },

          customCreateElement : function(tagName, id, className) {
              var tag = document.createElement(tagName);
              if (typeof id != 'undefined') {
                  tag.id = id;
              }

              if (typeof className != 'undefined') {
                  tag.className = className;
              }
              return tag;
          },

         createMsgBox : function(msg, id, className, imageTag) {
              var divTag = this.customCreateElement('div', id, className);
              if (typeof imageTag == 'undefined') {
                  var imageHolder = this.customCreateElement('div', id + 'img', className + 'img');
                  divTag.appendChild(imageHolder);
              }

              var pTag = this.customCreateElement('p', id + 'Para');
              pTag.innerHTML = msg;
              divTag.appendChild(pTag);
              return divTag;
          },

          disappearBox : function(className) {
              var allDivs = document.getElementsByClassName(this.msgBoxClass + className);
              if (allDivs[0] != null) {
                  allDivs[0].parentNode.removeChild(allDivs[0]);
              }
          },

          multiMediaMsg : function(className) {
              if (vApp.system.mybrowser.name == 'Firefox') {
                  var msg = vApp.lang.getString('wbrtcMsgFireFox');
                  this.displayMessage(msg, "fireFoxWebrtcCont", this.msgBoxClass + className);

              } else if (vApp.system.mybrowser.name == 'Chrome') {
                  var msg = vApp.lang.getString('wbrtcMsgChrome');
                  this.displayMessage(msg, "chormeWebrtcCont", this.msgBoxClass + className);
              }
          },

          canvasDrawMsg : function(className) {
              var mainContainer = document.getElementById('vcanvas');
              mainContainer.className = 'canvasMsgBoxParent';
              if (vApp.system.mybrowser.name == 'Firefox') {
                  var msg = vApp.lang.getString('canvasDrawMsg');
                  this.displayMessage(msg, "canvasDrawMsgContFirefox", this.msgBoxClass + className, 'containerWb');

              } else if (vApp.system.mybrowser.name == 'Chrome') {
                  var msg = vApp.lang.getString('canvasDrawMsg');
                  this.displayMessage(msg, "canvasDrawMsgContChrome", this.msgBoxClass + className, 'containerWb');
              }
          },

          drawLabel : function(className) {
              var msg = vApp.lang.getString('drawArea');
              this.displayMessage(msg, "canvasDrawArea", this.msgBoxClass + className, 'containerWb', false);
          },

            displayMsgBox : function (id, msg){
              var div = this.customCreateElement('div', id);
              var p = this.customCreateElement('p', id + "Para");
              p.innerHTML = vApp.lang.getString(msg);
              div.appendChild(p);
              var a = this.customCreateElement('a', id + "Anchor");
              a.href = window.location;
              a.innerHTML = vApp.lang.getString('reload');
              a.onclick = function (){
                  window.location.reload();
              }
              div.appendChild(a);

              var vAppCont = document.getElementById('vAppCont');
              vAppCont.insertBefore(div, vAppCont.firstChild);
          },

          displayServerError : function (id, msg){
              var div = this.customCreateElement('div', id);
              div.innerHTML = msg;
              var vcanvas = document.getElementById('vcanvas');
              vcanvas.parentNode.insertBefore(div, vcanvas);
          },

          removeElement : function (id){
              var errorDiv = document.getElementById(id);
              if(errorDiv != null){
                 errorDiv.parentNode.removeChild(errorDiv);
              }
          }

        };
        view = view.init();

        count = 0;
        view.window.resizeFinished = (function() {
            var timer = 0;
            return function(callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();

        view.window.resize = function() {

            var res = vApp.system.measureResoultion({'width': window.innerWidth, 'height': window.innerHeight});
            vApp.vutil.setContainerWidth(res);
            vcan.renderAll();
        },

//TODO
// this code is not using should be removed
        view.virtualWindow.manupulation = function(e) {
            var message = e.message.virtualWindow;
            if (message.hasOwnProperty('removeVirtualWindow')) {
                if (e.fromUser.userid != wbUser.id) {
                    vApp.wb.utility.removeVirtualWindow('virtualWindow');
                }
                return;
            } else if (message.hasOwnProperty('createVirtualWindow')) {
                if (message.hasOwnProperty('toolHeight')) {
                    localStorage.setItem('toolHeight', message.toolHeight);
                }

                if (e.fromUser.userid != wbUser.id) {
                    vApp.wb.utility.createVirtualWindow(message.createVirtualWindow);
                    return;
                }
            } else if (message.hasOwnProperty('shareBrowserWidth')) {
                if (message.hasOwnProperty('toolHeight')) {
                    localStorage.setItem('toolHeight', message.toolHeight);
                }

                if (localStorage.getItem('teacherId') != null) {
                    var toolBoxHeight = vApp.wb.utility.getWideValueAppliedByCss('commandToolsWrapper');
                    localStorage.setItem('toolHeight', toolBoxHeight);
                }

                if (e.fromUser.userid != wbUser.id) {
                    if (localStorage.getItem('teacherId') != null) {
                        vApp.wb.utility.makeCanvasEnable();
                    }
                    otherBrowser = message.browserRes;
                } else {
                    myBrowser = vApp.system.measureResoultion({'width': window.outerWidth, 'height': window.innerHeight});
                }

                if (typeof myBrowser == 'object' && typeof otherBrowser == 'object') {
                    if (myBrowser.width > otherBrowser.width) {
                        if (!vApp.wb.gObj.virtualWindow) {
                            vApp.wb.utility.createVirtualWindow(otherBrowser);
                            vApp.wb.gObj.virtualWindow = true;
                        }
                    } else if (myBrowser.width < otherBrowser.width) {
                        if (!vApp.wb.gObj.virtualWindow) {
                           // vApp.wb.gObj.virtualWindow = true;
                           var canvaContainer = document.getElementById("vcanvas");
                           var rightOffset = vApp.wb.utility.getElementRightOffSet(canvaContainer);
                            if (localStorage.getItem('teacherId') != null) {
                                vApp.wb.utility.beforeSend({'virtualWindow': {'createVirtualWindow': myBrowser - rightOffset, 'toolHeight': toolBoxHeight}});
                            } else {
                                vApp.wb.utility.beforeSend({'virtualWindow': {'createVirtualWindow': myBrowser - rightOffset}});
                            }
                        }
                    }
                }
            }
            return;
        }
        window.view = view;
    }
)(window);
