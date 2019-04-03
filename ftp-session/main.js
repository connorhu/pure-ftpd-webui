const http = require('http')
const { exec } = require('child_process');
const port = 3000
const dev = false

const requestHandler = (request, response) => {
    // TODO: read this from directly
    exec(dev ? `cat ${__dirname}/content.txt` : '/usr/sbin/pure-ftpwho -s', (err, stdout, stderr) => {
        if (err) {
            response.end('{}')
            return;
        }
        
        let buffer = [];
        
        stdout.split("\n").forEach(function (line) {
            buffer.push(line.split('|'))
        })
        
        response.end(JSON.stringify(buffer))
    });
}

const server = http.createServer(requestHandler)

server.listen(port, (err) => {
    if (err) {
        return console.log('something bad happened', err)
    }

    console.log(`server is listening on ${port}`)
})
