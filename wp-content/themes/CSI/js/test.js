/**
 * Created by simthembile.metshile on 2016/03/21.
 */
var someFunction = function() {
    return Try.these (
            function() {
                //code
                variable;
                alert(1);
                return 1;
            },
            function() {
                //code
                alert(2);
                return 2;
                variable;
            }
        ) || false;
}
alert(someFunction());