<?php

use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        set_time_limit(0);
        
        $this->tosql('seeds/sql/province.sql');
        $this->tosql('seeds/sql/city.sql');
        $this->tosql('seeds/sql/area.sql');
        $this->tosql('seeds/sql/street.sql');
        
    }
    
    public function tosql($sqlPath){
        $start = memory_get_usage();
        echo $this->convert($start) . PHP_EOL;
        $startTime = microtime(true);
        
        
        $sql = file_get_contents(database_path($sqlPath));
        DB::unprepared($sql);
        
        
        $endTime = microtime(true);
        $memoryUse = memory_get_usage();
        
        echo "内存占用：" . $this->convert($memoryUse) . "; 用时：" . ($endTime - $startTime) . PHP_EOL;
    }
    
    public function convert($size){
        $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');    
    
        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }
    
}
