import LogItem from './log-item';

const AVERAGE_WORD_LENGTH = 5;

// functional style class, use static variables?
class DataAggregate {
    chunked_data: { chunked_timestamp: number, log_items: LogItem[] }[] = []
    chunking_interval = 0;

    constructor(chunking_interval: number) {
	this.chunking_interval = chunking_interval;
    }
    
    append_item(item: LogItem) {
	const key = DataAggregate.current_time_key(item.ms_timestamp, this.chunking_interval);
	const last_chunk = this.chunked_data[this.chunked_data.length - 1];
	
	if (last_chunk !== undefined && last_chunk.chunked_timestamp === key) {
	    last_chunk.log_items.push(item);
	} else {
	    this.chunked_data.push({ chunked_timestamp: key, log_items: [item] })
	}
    }

    public static current_time_key(current_time: number, chunking_inteval: number) : number {
	return Math.floor(current_time / chunking_inteval) * chunking_inteval
    }
    
    public static wpm(chunk: LogItem[], chunking_interval: number) : number {
	return chunk.length * 60 * 1000 / chunking_interval / AVERAGE_WORD_LENGTH
    }

    public static mpm(chunk: LogItem[], chunking_interval: number) : number {
	return chunk.length * 60 * 1000 / chunking_interval
    }

    public static cpm(chunk: LogItem[], chunking_interval: number) : number {
	return chunk.length * 60 * 1000 / chunking_interval
    }
}

export default DataAggregate;
