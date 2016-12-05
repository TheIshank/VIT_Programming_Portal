/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Licensed under MIT License.
 *
 * Codejudge Compiler Server: Compiler for the C++ language
 */

package codejudge.compiler.languages;

import java.io.BufferedWriter;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.OutputStreamWriter;

import codejudge.compiler.TimedShell;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;

public class Cpp extends Language {
	
	String file, contents, dir;
	int timeout;
	
	public Cpp(String file, int timeout, String contents, String dir) {
		this.file = file;
		this.timeout = timeout;
		this.contents = contents;
		this.dir = dir;
	}
	public void compile(Language l) {
		try {
			BufferedWriter out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "/" + file)));
			out.write(contents);
			out.close();
			// create the compiler script
			out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "/compile.bat")));
			out.write("cd \"" + dir +"\"\n");
			out.write("g++ -lm " + file + " 2> err.txt");
			out.close();
			Runtime r = Runtime.getRuntime();
			Process p = r.exec(dir + "/compile.bat");
			p.waitFor();
			p = r.exec(dir + "/compile.bat"); // execute the compiler script
                        System.out.println("Before Time shell");
                        TimedShell shell = new TimedShell(this, p, 3000);
			shell.start();
			p.waitFor();
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
	}
        
       public void execute(Language l) {
		try {
			// create the execution script
			BufferedWriter out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "\\run.bat")));
			out.write("cd \"" + dir +"\"\n");
                        
			//out.write("chroot .\n");
			//out.write("./a.out < in.txt > out.txt");
                        //can be shortened
                        BufferedWriter testCaseWriter = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "\\testcase.txt")));
                        file=file.replace(".c", ".exe");
                        BufferedReader in = new BufferedReader(new FileReader(dir+"\\in.txt"));
                        File file = new File(dir + "\\testcase.txt");    
                        String fileContent=in.readLine();
                        int num = fileContent.length() - fileContent.replaceAll(";","").length();
                        BufferedWriter testOut = new BufferedWriter(new FileWriter(file,false));
                        BufferedReader in1 = new BufferedReader(new FileReader(file));
                        String Output = "";
                        String line = "";
                        out.write("a.exe < testcase.txt > out.txt");
                        out.close();
     
   
                while(num!=0)
                {       //System.out.println("num = " + num+"\n");
                        testOut = new BufferedWriter(new FileWriter(file,false));
                        int firstOccur = fileContent.indexOf(";");
                        String testCase = fileContent.substring(0, firstOccur);
                        testOut.write(testCase);
                        testOut.close();
                        fileContent = fileContent.replaceAll(testCase+";","");
                        num--; 
			Runtime r = Runtime.getRuntime();
                        System.out.println("Before Execution\n");
			Process p = r.exec(dir + "\\run.bat");//"chmod +x " + 
                        
		       // p.waitFor();
			//p = r.exec(dir + "\\run.bat"); // execute the script
                        
			TimedShell shell = new TimedShell(this, p, timeout);
			shell.start();
                        
			p.waitFor();
                        System.out.println("read from here 1\n");
                        BufferedReader readOutput = new BufferedReader(new FileReader(dir + "\\out.txt"));
                        
                        if(l.timedout){
                            System.out.println("read from here2\n");
                            Output = Output + "timeout;\n";
                        }
                        else
                        {
                            
                        line = readOutput.readLine();      
                       System.out.println("read from here3\n");
                        while(line!=null)
                       {
                           
                           Output = Output+line+"\n";
                           
                           line = readOutput.readLine();
                       } 
                        Output = Output + ";\n" ;
                       }
                       System.out.println("output -"+ Output);// To debug
                    
                        //append the output of testcases
                       
             
		} 
                     //Output = Output+"\n";
                        Output = Output.substring(0, Output.length()-1);
                        //System.out.println(Output);            
                        BufferedWriter writeOutput = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "\\out.txt")));
                        writeOutput.write(Output);
                        writeOutput.close();
                        /*BufferedReader readOutput = new BufferedReader(new FileReader(dir + "\\out.txt"));
                          System.out.println(readOutput.readLine()); To debug*/
                 
                } 
              
                  
                
                catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
                
        
                
       }     
        
 
}
