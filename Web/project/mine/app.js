const express = require('express')
const fs = require('fs')
const cors = require('cors')
const app = express()
const port = 3000

const readJSONFile = async (path) => {
    return JSON.parse(await fs.promises.readFile(path, 'utf-8'))
}

const writeJSONFile = async (path, data) => {
    await fs.promises.writeFile(path, JSON.stringify(data, null, 2))
}

app.use(cors())
app.use(express.json());

app.get('/data', (req, res) => {
    console.log('GET /data called');
    readJSONFile('./database.json').then(data => {
        res.send(data)
    })
})

app.put("/data", (req, res) => {
    console.log('POST /data called');
    readJSONFile('./database.json').then(data => {
        data.push(req.body)
        writeJSONFile('./database.json', data)
        res.send(data)
    })
})

app.post("/data", (req, res) => {
    console.log('POST /data called');

    readJSONFile('./database.json').then(data => {
        const dataAnime = {
            id: data.length + 2,
            img: req.body.img,
            title: req.body.title,
            rank: 0,
            score: 0,
            rating: req.body.rating,
            genre: req.body.genre,
            premium: req.body.premium
        }
        data.push(dataAnime)
        writeJSONFile('./database.json', data)
        res.send(data)
    })
})

app.delete("/data/:id", async (req, res) => {
    console.log('DELETE /data called');
    const id = req.params.id;
    try {
        let data = await readJSONFile('./database.json');
        data = data.filter(item => item.id != id);
        await writeJSONFile('./database.json', data);
        res.send(data);
    } catch (error) {
        console.error('Error handling DELETE /data request:', error);
        res.status(500).send('Internal Server Error');
    }
});

app.put("/edit-data/:id", async (req, res) => {
    console.log('PUT /data called');
    const id = req.params.id;
    try {
        let data = await readJSONFile('./database.json');
        console.log(req.body);
        data = data.map(item => {
            if (item.id == id) {
                {
                    item.id = req.body.id
                    item.title = req.body.title
                    item.img = req.body.img
                    item.rating = req.body.rating
                    item.genre = req.body.genre
                    item.premium = req.body.premium === 'true' ? true : false;
                }
            }
            return item
        })
        await writeJSONFile('./database.json', data);
        res.send(data);
    } catch (error) {
        console.error('Error handling PUT /data request:', error);
        res.status(500).send('Internal Server Error');
    }
});

app.listen(port, () => {
    console.log(`Example app listening on port ${port}`)
})