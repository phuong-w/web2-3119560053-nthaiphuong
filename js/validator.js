function Validator(formSelector) {
  var _this = this
  var formRules = {}
  // Gán giá trị mặc định cho tham số (ES5)
  
  function getParent(element, selector){
    while(element.parentElement){
      if (element.parentElement.matches(selector)){
        return element.parentElement
      }
      element = element.parentElement
    }
  }

  /**
   * Quy ước tạo rule:
   * - Nếu có lỗi thì return `error message`
   * - Nếu không có lỗi thì return `undefined`
   */
  var validatorRules = {
    required: function (value) {
      return value ? undefined : 'Vui lòng nhập trường này'
    },
    min: function (min) {
      return function (value) {
        return value.length >= min ? undefined : `Vui lòng nhập ít nhất ${min} ký tự `
      }
    },
    max: function (max) {
      return function (value) {
        return value.length <= max ? undefined : `Vui lòng nhập tối đa ${max} ký tự `
      }
    },
    number: function (value) {
      return value > 0 ? undefined : `Dữ liệu phải là một số dương`
    },
    select: function (value) {
      return value !== '' ? undefined : `Chọn một danh mục`
    },

    // file: function (size) {
    //   return  function (value) {
    //     let value = 1048576;
    //     return (value/convertMB) != size ? undefined : `Kích thước tối đa 2MB`;
    //   }
      // let num = 1048576;

      // let imgSizeMB = (file[0].size / num).toFixed(1);
      // console.log(file)
      
    file: function (value) {
      return value ? undefined : `Chưa chọn file`
    }

  }
    // Lấy ra form element trong DOM theo `formSelector`
    var formElement = document.querySelector(formSelector)
    // Chỉ xử lý khi có element trong DOM
    if (formElement) {
      var inputs = formElement.querySelectorAll('[name][rules]')
      for (var input of inputs) {
        // Cắt chuỗi theo ký tự `|`
        var rules = input.getAttribute('rules').split('|')
        
        for (var rule of rules){
          var ruleInfo
          var isRuleHasValue = rule.includes(':')
  
          // Cắt chuỗi theo ký tự `:`
          if (isRuleHasValue){
            ruleInfo = rule.split(':')
            rule = ruleInfo[0]
          }
          
          var ruleFunc = validatorRules[rule]
          
          if (isRuleHasValue){
            ruleFunc = ruleFunc(ruleInfo[1])
          }
  
          if (Array.isArray(formRules[input.name])){
            // Lần đầu tiên là object
        
            formRules[input.name].push(ruleFunc)
          } else {
            // Lần đầu tiên không phải là mảng nên nó sẽ lọt vào đây
            // Được gán giá trị mảng cho lần đầu tiên
            formRules[input.name] = [ruleFunc] 
          }
        }
        
        // Lắng nghe sự kiện để validate (blur, change, ...)
        input.onblur = handleValidate
        input.oninput = handleClearError
      }
      // Hàm thực hiện validate
      function handleValidate(event) {
        var rules = formRules[event.target.name]
        
        var errorMessage
        
        for (var rule of rules){

          errorMessage = rule(event.target.value)
          if (errorMessage) break
        }
        // Nếu có lỗi thì hiển thị message lỗi ra UI
        if (errorMessage){
          var formGroup = getParent(event.target, '.form-group')
          if (formGroup){
            formGroup.classList.add('invalid')
            var formMessage = formGroup.querySelector('.form-message')
            if (formMessage){
              formMessage.innerHTML = errorMessage
            }
          }
        }
        return !errorMessage
        // validate không có lỗi trả về true
      }
  
      // Hàm clear message lỗi
      function handleClearError(event) {
        var formGroup = getParent(event.target, '.form-group')
        if (formGroup.classList.contains('invalid')){
          formGroup.classList.remove('invalid')
  
          var formMessage = formGroup.querySelector('.form-message')
          if (formMessage){
            formMessage.innerHTML = ''
          }
        }
      }
    }
  
    // Xử lý hành vi submit form
    formElement.onsubmit = function (event) {
      event.preventDefault()  
  
      var inputs = formElement.querySelectorAll('[name][rules]')
      var isValid = true
      for (var input of inputs){
        if (!handleValidate({target: input})){
          isValid = false
        }
      }
      // Khi không có lỗi thì submit form
      if (isValid){
        if (typeof _this.onSubmit === 'function'){
          var enableInput = formElement.querySelectorAll('[name]')
          var formValues = Array.from(enableInput).reduce(function(values, input) {
              
              switch(input.type) {
                case 'file':
                  values[input.name] = input.files[0].size
                  break
                default:
                  values[input.name] = input.value
              }
              return values
          }, {})
          // Gọi lại hàm onSubmit và trả về lại giá trị của form
          _this.onSubmit(formValues)
        } else {
          formElement.submit()
        }
      }
    }
  }