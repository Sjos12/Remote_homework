        // reference canvas element (with id="c")
        // create a wrapper around native canvas element (with id="c")
        var canvas = new fabric.Canvas('c');
        canvas.calcOffset();
        console.log('this works!');
        function spawntext() {

            var text = new fabric.IText("Text",{
                fontFamily: 'montserrat',
             });
            canvas.add(text);
            canvas.centerObject(text);
            canvas.renderAll();
            } 

        function spawncube() {
            // create a rectangle object
            var rect = new fabric.Rect({
                stroke: 'black',
                strokeWidth: 2, 
                strokeUniform: true,
                fill: 'rgba(0,0,0,0)',
                width: 400,
                height: 200
            });
            canvas.add(rect);
            rect.center();
            canvas.renderAll();
        } 

        function spawncircle() {
            // create a rectangle object
            var circle = new fabric.Circle({
                radius: 100,
                 fill: '',
                 stroke: 'black',
                 strokeWidth: 3,
            });
            canvas.add(circle);
            circle.center();
            canvas.renderAll();
        } 
        
        function changetextcolor(clr) {
            var color = clr; 
            var obj = canvas.getActiveObject();
            var typecheck = obj.get('type');
            
            console.log(typecheck);
            if (typecheck == 'circle' || typecheck == 'rect') {
                obj.set('stroke', (color));
                console.log('hey');
            }
            else if (typecheck == 'i-text') {
                obj.set('fill', (color));
            }
            canvas.renderAll();
            console.log('hey');
        }  

        function removeactiveobject() { 

            var activeObject = canvas.getActiveObjects();
                console.log(activeObject)

                if (activeObject) {
                    activeObject.forEach(function(object) {
                    canvas.remove(object);
                    });
                    canvas.discardActiveObject();
                }
                canvas.renderAll();
        }

        