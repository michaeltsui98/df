Array.prototype.unique4 = function () {
    this.sort();
    var re = [this[0]];
    for (var i = 1; i < this.length; i++) {
        if (this[i] !== re[re.length - 1]) {
            re.push(this[i]);
        }
    }
    return re;
}
 
    $(function () {
        swf = {
            'checkExisting': domain + '/Disk/checkFileExists?dirId=' + dirId + '&disk_id=' + diskId + '',
            'diskId': diskId,
            'dirId': dirId,
            'url': commonParams.dodoStaticPath + '/shequPage/common/script/uploadify/uploadify.swf',
            'files': []
        };
        $('#file_upload').uploadify({
            'formData': {
                'dirId': dirId,
                'diskId': diskId,
                'timestamp': timestamp,
                'token': token,
                'p': page,

            },
            'fileSizeLimit': balanSize,
            'swf': swf.url,
            'scriptData': { 'PHPSESSID': sid },
            'uploader': domain + '/Disk/fileUploadDone?PHPSESSID=' + sid,
            'removeTimeout': 2,
            'debug': false,
            'uploadLimit': 5,
            'buttonText': '文件上传',
            'onUploadStart': function (file) {
                $.ajax({
                    type: 'POST',
                    async: false,
                    url: swf.checkExisting,
                    data: { filename: file.name },
                    success: function (data) {
                        if (data == 1) {
                            var overwrite = confirm('A file with the name "' + file.name + '" already exists on the server.\nWould you like to replace the existing file?');
                            if (!overwrite) {
                                $('#file_upload').uploadify('cancel', file.id);
                                $('#' + file.id).remove();
                            }
                        }
                    }
                });
            },
            'onQueueComplete': function (queue) {
                //异步刷新父页面列表
                getFilesList();
            },

            'onUploadSuccess': function (file, data, response) {
                swf.files.push(data);
                swf.files.unique4();
            }
        });
    });
 

