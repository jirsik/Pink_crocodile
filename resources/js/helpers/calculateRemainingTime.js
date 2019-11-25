const calculateRemainingTime = (a, b) => {
    let start = new Date(a)
    let end = new Date(b)

    let diff =(end.getTime() - start.getTime()) / 1000
    let hours = Math.floor(diff / (60 * 60))
    hours < 10 ? hours = `0${hours}` : hours

    let divisor_mins = diff % (60 * 60)
    let minutes = Math.floor( divisor_mins/60 )
    minutes < 10 ? minutes = `0${minutes}` : minutes

    let divisor_secs = divisor_mins % 60
    let seconds = Math.ceil(divisor_secs)
    seconds < 10 ? seconds = `0${seconds}` : seconds
    
    return `${hours}:${minutes}:${seconds}`
}

export default calculateRemainingTime;
