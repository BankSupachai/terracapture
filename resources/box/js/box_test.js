    const box = async (id,arr,file) => {
        // const myObj     = JSON.parse(arr);
        const response  = await fetch(file);
        const aaa       = await response.text();
        txt = boxcountforeach(aaa,arr);
        $(id).html(txt);
    }

    function boxforeach(boxstr,var_first,var_second){
        string_all  = boxstr.replaceAll(var_second+'->', '');
        txt         = "";
        var_first.forEach(function(el, index) {txt += invert_variable(string_all,var_first[index]);});
        return txt;
    }

    function boxcountforeach(boxstr,boxarr){
        string_all      = boxstr.replaceAll('@', '@##');
        var regex       = /@##foreach/gi, string_all, indices = [];
        var regex2      = /@##endforeach/gi, string_all, indices2 = [];
        while(result    = (regex.exec(string_all))){indices.push(result.index);}
        while(result2   = (regex2.exec(string_all))){indices2.push(result2.index);}

        indices.forEach(function(el, index) {
            point_start     = indices[0];
            point_end       = indices2[0];

            str_start       = string_all.substring(0,point_start);
            str_end         = string_all.substring(point_end+13,string_all.length);

            foreach_str     = string_all.substring(point_start,point_end);
            as_foreachstart = foreach_str.search(' as ');
            replace_start   = foreach_str.replace('($','%%');
            replace_end     = foreach_str.replace(')','%%');
            ddd             = replace_end.search('%%');
            eee             = replace_start.search('%%');
            var_first       = replace_start.substring(eee+2,as_foreachstart);
            var_second      = replace_start.substring(as_foreachstart+5,ddd);
            str_in_foreach  = string_all.substring(point_start+ddd+2,point_end);
            newarray        = 'boxarr.'+var_first;

            //new string
            string_all       = str_start;
            string_all      += boxforeach(str_in_foreach,eval(newarray),var_second);
            string_all      += str_end;

            indices         = [];
            indices2        = [];
            while(result    = (regex.exec(string_all))){indices.push(result.index);}
            while(result2   = (regex2.exec(string_all))){indices2.push(result2.index);}
        });


        string_all = invert_variable(string_all,boxarr);
        return string_all;
    }

    function invert_variable(file,boxarr){
        var aaa         = file.replaceAll("}}", "--@")
        var bbb         = aaa.replaceAll("{{$", "@--")
        var count       = (bbb.match(/@--/g) || []).length;
        let arr         = Array.from(Array(count), () => new Array(3));

        var regex       = /@--/gi, bbb, indices = [];
        var regex2      = /--@/gi, bbb, indices2 = [];

        while((result   = regex.exec(bbb))){indices.push(result.index);}
        while((result2  = regex2.exec(bbb))){indices2.push(result2.index);}

        var vartext = "";
        for (let i = 0; i<count; i++) {
            arr[i][0]   = indices[i];
            arr[i][1]   = indices2[i];
            arr[i][2]   = bbb.substring(indices[i],indices2[i]+3);
            arr[i][3]   = bbb.substring(indices[i]+3,indices2[i]);
            vartext     = bbb.substring(indices[i]+3,indices2[i]);
            if(boxarr[vartext]!=null){
                arr[i][4] = true;
            }else{
                arr[i][4] = false;
            }
        }
        arr.forEach(function(el, index) {
            if(arr[index][4]){
                bbb = bbb.replaceAll(arr[index][2], boxarr[arr[index][3]]);
            }else{
                bbb = bbb.replaceAll(arr[index][2], "");
            }
        });
        return bbb;
    }
