/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Licensed under MIT License.
 *
 * Codejudge Compiler Server: Compiler for the Java language
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

public class Java extends Language {
	
	String file, contents, dir;
	int timeout;
	
	public Java(String file, int timeout, String contents, String dir) {
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
			out.write("javac " + file + " 2> err.txt");
			out.close();
			Runtime r = Runtime.getRuntime();
			Process p = r.exec(dir + "/compile.bat");//"chmod +x " 
			p.waitFor();
			p = r.exec(dir + "/compile.bat"); // execute the compiler script
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
                        BufferedWriter testCaseWriter = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "\\testcase.txt")));
                        BufferedReader in = new BufferedReader(new FileReader(dir+"\\in.txt"));
                        String fileName=file;
                        File file = new File(dir + "\\testcase.txt");    
                        String fileContent=in.readLine();
                        int num = fileContent.length() - fileContent.replaceAll(";","").length();
                        BufferedWriter testOut = new BufferedWriter(new FileWriter(file,false));
                        BufferedReader in1 = new BufferedReader(new FileReader(file));
                        String Output = "";
                        String line = "";
                        out.write("java -cp " + dir +" "+  fileName.substring(0, fileName.length() - 5) + " < testcase.txt > out.txt");
                        out.close();
     
   
    while(num!=0)
    {  
                        testOut = new BufferedWriter(new FileWriter(file,false));
                        int firstOccur = fileContent.indexOf(";");
                        String testCase = fileContent.substring(0, firstOccur);
                        testOut.write(testCase);
                        testOut.close();
                        fileContent = fileContent.replaceAll(testCase+";","");
                        num--; 
			Runtime r = Runtime.getRuntime();
			Process p = r.exec(dir + "\\run.bat");//"chmod +x " + 
                        
			//p.waitFor();
			//p = r.exec(dir + "\\run.bat"); // execute the script
                       
			TimedShell shell = new TimedShell(this, p, timeout);
			shell.start();
			p.waitFor();	
                       
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
                         System.out.println("Inside while Loop\n");

                           Output = Output+line+"\n";
                           
                           line = readOutput.readLine();
                       } 
                        Output = Output + ";\n" ;
                       }
                       System.out.println("output -"+ Output);// To debug
                       readOutput.close();
                    
             
		} 
                     
                     //Output = Output+"\n";
                      Output = Output.substring(0, Output.length()-1);
                      System.out.println(Output);            
                      BufferedWriter writeOutput = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "\\out.txt")));
                      writeOutput.write(Output);
                      writeOutput.close();
                     // BufferedReader readOutput = new BufferedReader(new FileReader(dir + "\\out.txt"));
              // System.out.println(readOutput.readLine());
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
