import md5 from 'js-md5'
import { chunk , merge } from "@/api/upload";
// 分片上传
/*
* 分片上传函数 支持多个文件
* @param options
* options.file 表示源文件
* options.chunk 分片上传的后端地址
* options.merge 整个文件的上传地址
* progress 进度回调
* success 成功回调
* error 失败回调
*
*/
export const initUpload = ({files, progress, success, error}) => {
  if (!files || !files.length) return

  let fileList = [] // 总文件列表
  let progressNum = 1 // 进度
  let successAllCount = 0 // 上传成功的片数
  let AllChunk = 0 // 所有文件的chunk数之和
  let AllFileSize = 0 // 所有文件size
  let chunkSize = 0 // 所有文件size

  const readFileMD5 = (files) => {
    // 读取每个文件的md5
    files.map((file, index) => {
      let fileRederInstance = new FileReader()
      fileRederInstance.readAsBinaryString(file)
      fileRederInstance.addEventListener('load', e => {
        let fileBolb = e.target.result
        let fileMD5 = md5(fileBolb)
        if (!fileList.some((arr) => arr.md5 === fileMD5)) {
          fileList.push({md5: fileMD5, name: file.name, file})
          AllFileSize = AllFileSize + file.size
        }
        //if (index === files.length - 1)
        readChunkMD5(fileList)
      }, false)
    })
  }
  // 根据文件大小，分配上传分片大小
  const  updateCchunkSize = (file) =>{
    if (file.size > 2000 * 1024 * 1024) {
        chunkSize = 1024 * 1024 * 15;
    } else if (file.size > 1000 * 1024 * 1024) {
        chunkSize = 1024 * 1024 * 10;
    } else if (file.size > 500 * 1024 * 1024) {
        chunkSize = 1024 * 1024 * 8;
    } else {
        chunkSize = 2 * 1024 * 1024;
    }
    return chunkSize
  }
  // 针对每个文件进行chunk处理
  const readChunkMD5 = (fileList) => {
    fileList.map((currentFile, fileIndex) => {
      const chunkSize = updateCchunkSize(currentFile.file)
      const chunkCount = Math.ceil(currentFile.file.size / chunkSize) // 总片数
      AllChunk = AllChunk + chunkCount // 计算全局chunk数
      // let fileSize = currentFile.file.size // 文件大小
      // 针对单个文件进行chunk上传
      var _i = 0
      for (var i = 0; i < chunkCount; i++) {
        const { chunk } = getChunkInfo(currentFile.file, i, chunkSize)
        let chunkFR = new FileReader()
        chunkFR.readAsBinaryString(chunk)
        chunkFR.addEventListener('load', e => {
          let chunkBolb = e.target.result
          let chunkMD5 = md5(chunkBolb)
          uploadChunk(currentFile, {chunkMD5, chunk, currentChunk: _i++, chunkCount}, fileIndex)
        }, false)
      }
    })
  }
  const getChunkInfo = (file, currentChunk, chunkSize) => {
    let start = currentChunk * chunkSize
    let end = Math.min(file.size, start + chunkSize)
    let chunk = file.slice(start, end)
    return { start, end, chunk }
  }

  const uploadChunk = (currentFile, chunkInfo, fileIndex) => {
    let data = new FormData()
    data.append('file_name', currentFile.name)
    data.append('md5', currentFile.md5)
    data.append('data', chunkInfo.chunk)
    data.append('chunks', chunkInfo.chunkCount)
    data.append('index', chunkInfo.currentChunk)
    data.append('chunk_md5', chunkInfo.chunkMD5)

    chunk(data).then(res => {
      progressFun()
      if (chunkInfo.currentChunk < chunkInfo.chunkCount - 1) {
        successAllCount++
      } else {
        // 当总数大于等于分片个数的时候
        if (chunkInfo.currentChunk >= chunkInfo.chunkCount - 1) {
          uploadFile(currentFile, fileIndex)
        }
      }
    }).catch(e => {
        uploadChunk(currentFile, chunkInfo, fileIndex);
      error && error(e)
    })
  }

  // 更新进度
  const progressFun = () => {
    progressNum = Math.ceil(successAllCount / AllChunk * 100)
    progress(progressNum)
  }
  // 对分片已经处理完毕的文件进行上传
  const uploadFile = (currentFile) => {
    let data = new FormData()
    console.log(currentFile)
    data.append('md5', currentFile.md5)
    data.append('file_name', currentFile.name)
    merge(data).then(res => {
      progressFun()
      res.file_name = currentFile.name
      success && success(res)
      successAllCount++
    }).catch(e => {
      error && error(e)
    })
  }

  readFileMD5(files) // 开始执行代码
}
