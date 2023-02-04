function cutText(text) {
  if (text.length > this.maxLength) {
    return text.substr(0, this.maxLength) + '...';
  }
}


export{cutText}