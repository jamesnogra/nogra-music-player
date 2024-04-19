<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4 music-player-container">
                    <div class="music-album-container mb-3">
                        <img class="music-album" src="@/images/piano.avif" alt="Album Art Test">
                    </div>
                    <div class="song-title mb-1">{{ songs[songIndex]?.song }}</div>
                    <div class="small-text mb-3">{{ songs[songIndex]?.artist }}</div>
                    <div class="music-controls-container mb-5">
                        <i class="fa-solid fa-shuffle small-icon" @click="shuffleSongs"></i>
                        <i class="fa-sharp fa-solid fa-backward-step small-icon" @click="previousSong"></i>
                        <i v-if="songIsPlaying" class="fa-solid fa-circle-pause large-icon" @click="pauseSong"></i>
                        <i v-if="!songIsPlaying" class="fa-solid fa-circle-play large-icon" @click="playSong"></i>
                        <i class="fa-sharp fa-solid fa-forward-step small-icon" @click="nextSong"></i>
                        <i>&nbsp;</i>
                    </div>
                    <div class="timer-container">
                        <div class="timer-runner"></div>
                        <div class="timer-circle" :style="`margin-left:${percentSong}%;`"></div>
                        <div class="timer-numbers">
                            <div class="small-text">{{ formatDuration(songSeconds) }}</div>
                            <div class="small-text">{{ formatDuration(songs[songIndex]?.duration) }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-8 playlist-container">
                    <div v-for="song in songs" :key="song.id" class="playlist-song-container">
                        <div class="playlist-pause">
                            <i v-if="song.id === songs[songIndex].id && songIsPlaying"
                                class="fa-solid fa-circle-pause small-icon" @click="pauseSong"></i>
                        </div>
                        <div class="playlist-song-artist">
                            <div class="song-title mb-1">{{ song.song }}</div>
                            <div class="small-text mb-3">{{ song.artist }}</div>
                        </div>
                        <div class="playlist-timer song-title mb-1">{{ formatDuration(song.duration) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'Song',
    data() {
        return {
            songs: [],
            songIndex: 0,
            songSeconds: 0,
            songIntervalId: null,
            songIsPlaying: false
        }
    },
    computed: {
        percentSong() {
            if (typeof this.songs[this.songIndex]?.duration === 'undefined') {
                return 0
            }
            return this.songSeconds / this.songs[this.songIndex].duration * 100
        }
    },
    mounted() {
        this.getSongs()
    },
    methods: {
        getSongs() {
            // Make an HTTP GET request to songs
            axios.get('/all-songs', this.formData)
                .then(response => {
                    this.songs = response.data.songs
                    this.shuffleArray(this.songs)
                })
                .catch(error => {
                    alert('Something went wrong...')
                })
        },
        formatDuration(durationInSeconds) {
            const minutes = Math.floor(durationInSeconds / 60)
            const seconds = durationInSeconds % 60
            return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`
        },
        previousSong() {
            this.songSeconds = 0
            if (this.songIndex === 0) {
                this.songIndex = this.songs.length-1
            } else {
                this.songIndex--
            }
        },
        nextSong() {
            this.songSeconds = 0
            if (this.songIndex === this.songs.length - 1) {
                this.songIndex = 0
            } else {
                this.songIndex++
            }
        },
        shuffleSongs() {
            this.shuffleArray(this.songs)
            this.songIndex = 0
        },
        shuffleArray(array) {
            this.songSeconds = 0
            let i = array.length
            while (i > 0) {
                const ri = Math.floor(Math.random() * i)
                i--
                [array[i], array[ri]] = [array[ri], array[i]]
            }
            return array
        },
        playSong() {
            this.songIntervalId = setInterval(() => {
                this.songSeconds++
                // Play next song if done
                if (this.songSeconds >= this.songs[this.songIndex].duration) {
                    this.nextSong()
                }
            }, 1000)
            this.songIsPlaying = true
        },
        pauseSong() {
            clearInterval(this.songIntervalId)
            this.songIsPlaying = false
        }
    }
}
</script>

<style scoped>
.music-player-container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: 100vh;
}
.music-album-container {
    width: 100%;
    height: 50%;
    border-radius: 20px;
    overflow: hidden;
}
.music-album {
    height: 100%;
}
.song-title {
    font-size: 20px;
    font-weight: bold;
}
.small-text {
    font-size: 14px;
    font-weight: 100;
}
.music-controls-container {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    text-align: center;
}
.music-controls-container i {
    width: 20%;
}
.small-icon {
    font-size: 24px;
}
.large-icon {
    font-size: 48px;
}
.small-icon, .large-icon {
    cursor: pointer;
}
.timer-container {
    width: 100%;
}
.timer-runner {
    width: 100%;
    border-bottom: 1px solid #fff;
}
.timer-circle {
    width: 14px;
    height: 14px;
    border-radius: 7px;
    background-color: #fff;
    margin-top: -7px;
}
.timer-numbers {
    display: flex;
    justify-content: space-between;
}
.playlist-container {
    max-height: 100vh;
    padding: 20px 0;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}
.playlist-song-container {
    display: flex;
    width: 100%;
}
.playlist-song-artist {
    width: 60%;
    padding-left: 20px;
}
.playlist-pause {
    width: 15%;
    margin-top: 6px;
    text-align: right;
}
.playlist-timer {
    width: 15%;
}
</style>
